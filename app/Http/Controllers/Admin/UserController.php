<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

use App\Models\Mail;
use App\Models\MailUser;
use App\Models\Country;
use App\Models\State;
use App\Models\Role;
use App\Models\TypeUser;

class UserController extends Controller {
    public $viewDir = "admin.user";

    public function index() {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::all();
        $records = User::findRequested();

        return $this->view("index", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create() {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request) {
        dd($request);
        /*$this->validate($request, User::validationRules());

        User::create($request->all());

        # notification
        Notify::success('User a été créer avec succès');
        return redirect(route('admin.user.index'));*/
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, User $user) {
        if(Auth::user()->id == $user->id){
            return redirect()->route('admin.profile');
        }
        return $this->view("info", ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user) {
        return $this->view("edit", ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        if ($request->isXmlHttpRequest()) {
            $data = [$request->name => $request->value];
            $validator = \Validator::make($data, User::validationRules($request->name));
            if ($validator->fails())
                return response($validator->errors()->first($request->name), 403);
            $user->update($data);
            return "Record updated";
        }

        $this->validate($request, User::validationRules());

        $user->update($request->all());

        # notification
        Notify::success('User a été mise à jour avec succès');
        return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user) {
        $this->middleware('auth');
        $this->middleware('role:1');
        
        if($user->id==1){
            Notify::error("Cette action ne peut pas etre réalisée.");
            return redirect(route('admin.user.index'));
        }
        $user->delete();

        # notification
        Notify::success('Utilisateur a été supprimer avec succès');
        return redirect(route('admin.user.index'));
    }

    protected function view($view, $data = []) {
        return view($this->viewDir . "." . $view, $data);
    }

    /**
     * Disable User
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function desactiver(Request $request, User $user) {

        if ($user->id == 1) {
            Notify::error("Cette action ne peut pas etre réalisée.");
            return redirect(route('admin.user.index'));
        }

        $user->status = 'disabled';
        $user->save();
        Notify::success("L'utilsateur a été desactivé avec succés");
        return redirect(route('admin.user.index'));


        /*if($user->id==1){
        echo 'ato';
        //return back()->with('error',"Cette action ne peut pas etre réalisée.");
        }

        $status = $user->status;
        $user->status = 'disabled';
        $user->save();
        
        try{
        $user->notify(new AccountDisabled($user, $status));
        }catch(\Exception $e){}
        
        Notify::error("L'utilsateur a été desactivé avec succés");
        return redirect(route('admin.user.index'));*/
    }

    public function active(Request $request, User $user) {

        if ($user->id == 1) {
            Notify::error("Cette action ne peut pas etre réalisée.");
            return redirect(route('admin.user.index'));
        }
        if($user->status == 'pinged'){
            $user->trial_ends_at = \Carbon\Carbon::now()->addDays(option('payment.trial_delay', 14));
        }
        $user->status = 'active';
        $user->save();
        Notify::success("L'utilsateur a été activé avec succés");
        return redirect(route('admin.user.index'));
    }
    
    public function contact(Request $request, User $user){
        $mail = new Mail();
        if($value = $request->old('subject'))    $mail->subject = $value;
        if($value = $request->old('content'))    $mail->content = $value;
        return $this->view("contact", ['user' => $user,'mail'=>$mail]);
    }

}
