<?php

namespace App\Http\Controllers\V2\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

use App\Mail;
use App\Models\MailUser;
use App\Country;
use App\State;

class UserController extends Controller {
    public $viewDir = "V2.admin.user";

    public function index() {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $records = User::findRequested();
        return $this->view("index", ['records' => $records]);
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
        $this->validate($request, User::validationRules());

        User::create($request->all());

        # notification
        Notify::success('User a été créer avec succès');
        return redirect(route('V2.admin.user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, User $user) {
        return $this->view("show", ['user' => $user]);
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
        return redirect(route('V2.admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user) {
        $user->delete();

        # notification
        Notify::success('User a été supprimer avec succès');
        return redirect(route('V2.admin.user.index'));
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
    public function disable(Request $request, User $user) {
        
        dd($request->all());
        
        
        if ($user->id == 1) {
            echo 'ato';
            //return back()->with('error',"Cette action ne peut pas etre réalisée.");
        }

        $user->status = 'disabled';
        $user->save();
        Notify::error("L'utilsateur a été desactivé avec succés");
        return redirect(route('V2.admin.user.index'));


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
        return redirect(route('V2.admin.user.index'));*/
    }

}
