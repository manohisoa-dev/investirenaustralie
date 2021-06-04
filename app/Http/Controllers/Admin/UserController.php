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
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notifications\AccountAdminActivated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Image;

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

    public function showSeller(Request $request) {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::where('type_user_name','!=','Admin blog')->where('type_user_name','!=','Admin delegate')->get();
        $userRole = 'seller';

        if(isset($request->country_id) || isset($request->state_id) || isset($request->name) || isset($request->type_users_id) || isset($request->status)){
            $users_array = User::findRequested()->where('role',2);
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/seller')]);
        }else{
            $users_array = User::where('role',2)->get();
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/seller')]);
        }
        
        return $this->view("showUser", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts, 'userRole' => $userRole]);
    }

    public function showAfa() {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::where('type_user_name','!=','Admin blog')->where('type_user_name','!=','Admin delegate')->get();
        $userRole = 'afa';

        if(isset($request->country_id) || isset($request->state_id) || isset($request->name) || isset($request->type_users_id) || isset($request->status)){
            $users_array = User::findRequested()->where('role',3);
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/afa')]);
        }else{
            $users_array = User::where('role',3)->get();
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/afa')]);
        }
        
        return $this->view("showUser", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts, 'userRole' => $userRole]);
    }

    public function showApl() {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::where('type_user_name','!=','Admin blog')->where('type_user_name','!=','Admin delegate')->get();
        $userRole = 'apl';

        if(isset($request->country_id) || isset($request->state_id) || isset($request->name) || isset($request->type_users_id) || isset($request->status)){
            $users_array = User::findRequested()->where('role',4);
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/apl')]);
        }else{
            $users_array = User::where('role',4)->get();
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/apl')]);
        }
        
        return $this->view("showUser", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts, 'userRole' => $userRole]);
    }

    public function showMember() {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::where('type_user_name','!=','Admin blog')->where('type_user_name','!=','Admin delegate')->get();
        $userRole = 'member';

        if(isset($request->country_id) || isset($request->state_id) || isset($request->name) || isset($request->type_users_id) || isset($request->status)){
            $users_array = User::findRequested()->where('role',5);
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/member')]);
        }else{
            $users_array = User::where('role',5)->get();
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/member')]);
        }
        
        return $this->view("showUser", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts, 'userRole' => $userRole]);
    }

    public function showMemberParticulier() {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::where('type_user_name','!=','Admin blog')->where('type_user_name','!=','Admin delegate')->get();
        $userRole = 'member.particulier';
        
        // $records = User::findRequested();

        if(isset($request->country_id) || isset($request->state_id) || isset($request->name) || isset($request->type_users_id) || isset($request->status)){
            $users_array = User::findRequested()->where('role',5)->where('type_users_id',2);
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/member/type/particulier')]);
        }else{
            $users_array = User::where('role',5)->where('type_users_id',2)->get();
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/member/type/particulier')]);
        }
        
        return $this->view("showUser", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts, 'userRole' => $userRole]);
    }

    public function showMemberOrganisation() {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::where('type_user_name','!=','Admin blog')->where('type_user_name','!=','Admin delegate')->get();
        $userRole = 'member.organisation';

        if(isset($request->country_id) || isset($request->state_id) || isset($request->name) || isset($request->type_users_id) || isset($request->status)){
            $users_array = User::findRequested()->where('role',5)->where('type_users_id',1);
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/member/type/organisation')]);
        }else{
            $users_array = User::where('role',5)->where('type_users_id',1)->get();
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/member/type/organisation')]);
        }
        
        return $this->view("showUser", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts, 'userRole' => $userRole]);
    }

    public function showCollaborator() {
        $this->middleware('auth');
        $this->middleware('role:1');

        $role = Role::all();
        $statuts = User::groupBy('status')->pluck('status', 'status');
        $countries = Country::all();
        $states = State::all();
        $typeUser = TypeUser::whereIn('type_user_name', ['Admin blog','Admin delegate'])->get();
        $userRole = 'collaborator';

        if(isset($request->country_id) || isset($request->state_id) || isset($request->name) || isset($request->type_users_id) || isset($request->status)){
            $users_array = User::findRequested()->where('role',6);
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/collaborator')]);
        }else{
            $users_array = User::where('role',6)->get();
            $records = new LengthAwarePaginator($users_array, count($users_array), 10, 1, ['path'=>url('admin/user/show/collaborator')]);
        }
        
        return $this->view("showUser", ['records' => $records, 'roles' => $role,
            'countries' => $countries, 'states' => $states, 'typeUser' => $typeUser,
            'statuts' => $statuts, 'userRole' => $userRole]);
    }

    /**
     * Show the form for creating a new collaborator.
     *
     * @return  \Illuminate\Http\Response
     */
    public function createCollaborator() {
        return $this->view("createCollaborator");
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
        $this->middleware('auth');
        $this->middleware('role:1');

        // $validator = $this->validate($request, User::validationRulesAdmin());
        
        // Get post datas
        $datas = $request->all();

        $validator = Validator::make($datas, [
            'login' => 'required|string|max:100',
            'email' => 'required|string|max:100|email',
            'first_name' => 'string|max:100',
            'last_name' => 'string|max:191',
            'language' => 'required',
            'password' => 'required|string',
            'permission' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        // Store Type User
        $datas['type_users_id'] = TypeUser::where('type_user_name','Admin blog')->first()->id;

        if($request->get('permission') === 1){
            $datas['type_users_id'] = TypeUser::where('type_user_name','Admin delegate')->first()->id;
        }else

        // Store Name
        $datas['name'] = $datas['first_name'].' '.$datas['last_name'];

        // Crypte password
        $password = $datas['password'];
        $passCrypte = Hash::make($datas['password']);
        $datas['password'] = $passCrypte;

        // Store Localization
        $datas['location_id'] = 0;
        
        // Store image file
        $datas['image_id'] = 0;
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id>0?$image->id:0;
        }

        // Store role
        $datas['role'] = 6;
                
        // $datas['password'] = Hash::make($password = str_random(10));
        $datas['use_default_password'] = 0;
        $datas['status'] = 'active';

        // Store image file
        $datas['image_id'] = 0;
        if($file=$request->file('avatar')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id>0?$image->id:0;
        }

        try{
            // Create user
            unset($datas['type']);
            $user = User::create($datas);
            // $user->handles($request);
            
        }catch (\Exception $exception) {
            logger()->error($exception);
            return back()->with('info', trans('app.txt.errorcreateuser'));
        }

        if(isset($request->send_notification)){
            // Notify User
            try{
                $user->notify(new AccountAdminActivated($user, $password));
            }catch(\Exception $e){}
        }

        # notification
        Notify::success(trans('app.txt.add.collaborator.success'));
        return redirect(route('admin.user.show.collaborator'));
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
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function showPart(Request $request, $role, User $user) {
        
        return $this->view("infoPart", ['user' => $user, 'role'=>$role]);
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
            return back();
        }
        $user->delete();

        # notification
        Notify::success('Utilisateur a été supprimer avec succès');
        return back();
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
