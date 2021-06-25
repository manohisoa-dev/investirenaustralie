<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Event;
use App;

use App\Notifications\AccountCreated;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Localisation;
use App\Models\Image;
use App\Models\Page;
use App\Models\Country;
use App\Models\State;
use App\Models\Role;
use App\Models\TypeUser;
use App\Models\Userinfo;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $datas
     * @return \App\Models\User
     */
    protected function create(array $datas)
    {
        $password = $datas['password'];
        $datas['password'] = bcrypt($password);
        $datas['status'] = 'pinged';
        
        return User::create($datas);
    }
    
    
    /**
     * Activate the user with given activation code.
     * @param string $code
     * @return String
     */
    public function activateUser($code)
    {
        try {
            $user = User::where('activation_code', $code)->first();
            if (!$user) {
                return redirect()->route('login')
                    ->with('error',trans('app.txt.codedoesnotexist'));
            }
            $user->status = 'active';
            $user->activation_code = null;
            $user->trial_ends_at = \Carbon\Carbon::now()->addDays(option('payment.trial_delay', 14));
            $user->save();
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->route('login')
                ->with('error', trans('app.txt.probleme.survenu'));
        }
        return redirect()->route('login')
                ->with('success',trans('app.txt.accountactivated'));
    }
    
    
    /**
     * Resend activation mail
     * @param User $user
     * @return String
     */
    public function resendActivation(User $user)
    {   
        if($user->active()){
            return back()
                ->with('error',trans('app.txt.useractived'));
        }
        
        try {
            $password = str_random(10);
            $user->password = bcrypt($password);
            $user->activation_code = md5(str_random(30).(time()*32));
            $user->save();
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->route('login')
                ->with('error',trans('app.txt.probleme.survenu'));
        }
        
        // Notify User
        $user->notify(new AccountCreated($user, $password));
        
        return redirect()->route('login')
            ->with('success', trans('app.txt.activationcodesent').'<br>'
                  .'<a class="btn btn-default" href="'.route('resend_code', $user).'">'.trans('app.txt.resendcode').'</a>');
        
    }
    
    /**
     * Show form registration switch $role
     *
     * @param  Illuminate\Http\Request  $request
     * @param  String $role
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $role)
    {
        $roles = trans('app.'.$role);
        $action = route('register.store',['role'=>$role]);
        $page = Page::where('path', '/register/'.$role)
            ->locale()
            ->first();
        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
        switch($role){
            case "member":
                $pays = $this->getPaysFromCsv();
                $tels = $this->getTelsFromCsv();
                return view('login.'.$role)
                    ->with('role', $roles)
                    ->with('action', $action)
                    ->with('countries', Country::all())
                    ->with('page', $page)
                    ->with('lapls', $lapls);
                break;
            case "afa":
                App::setLocale('en');
                $request->session()->put("step", "condition");
                return view('login.condition.afa')
                    ->with('role', $roles)
                    ->with('page', $page)
                    ->with('lapls', $lapls);
                break;
            case "apl":
                $request->session()->put("step", "condition");
                return view('login.condition.apl')
                    ->with('role', $roles)
                    ->with('page', $page)
                    ->with('lapls', $lapls);
                break;
            case "seller":
                App::setLocale('en');
                $request->session()->put("step", "condition");

                if($request->get('class')){
                    session()->forget('afa_id');
                    session()->forget('afa_name');
                    
                    return view('login.condition.sellerbyafa')
                        ->with('role', $roles)
                        ->with('page', $page)
                        ->with('lapls', $lapls);
                }else{
                    return view('login.condition.seller')
                        ->with('role', $roles)
                        ->with('page', $page)
                        ->with('lapls', $lapls);
                }
                break;
            default:
                abort(404);
        }
    }
    
    /**
     * Store user information into database
     *
     * @param  Illuminate\Http\Request  $request
     * @param  String $role
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $role)
    {
        // Switch to get Condition and Term count
        $conditionCount = 0;
        $view = view('login.'.$role);

        switch($role){
            case "afa":
                App::setLocale('en');
                $conditionCount = 4;
            break;
            case "apl":
                $conditionCount = 5;
            break;
            case "seller":
                App::setLocale('en');
                $request->session()->put("seller_class", $request->class);
                
                if(session('seller_class')!=='seller_by_afa'){
                    $conditionCount = 2;
                }else{
                    $view = view('login.sellerbyafa');
                    $conditionCount = 3;
                }
            break;
        }

        // Shown register form
        if($request->session()->get("step") == "condition" || $request->session()->get("step") == "register"){
            // Validate term check
            $count = 0;
            if(($conditions = $request->condition) && is_array($conditions)){
                foreach($conditions as $condition){
                    if($condition==1) $count++;
                }
            }
            
            if($count!=$conditionCount){
                return back()->with('error', trans('app.txt.mustagreeterme'));
            }

            $request->session()->put("step", "register");
            $action = route('register',['role'=>$role]);
            $lapls = Localisation::select('localizations.*')
            ->join('users','users.location_id','=','localizations.id')
            ->where('users.role','=','4')
            ->groupBy('localizations.locality')
            ->get();

            if(session('seller_class'))

            return $view
                    ->with('action', $action)
                    ->with('role', trans('app.'.$role))
                    ->with('states', State::all())
                    ->with('lapls', $lapls)
                    ->with('countries', Country::all());
            
        }
        
        
        // Open First Page of registration
        return redirect()->route('register',['role'=>$role]);
        
    }

        /**
     * Store user information into database
     *
     * @param  Illuminate\Http\Request  $request
     * @param  String $role
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $role)
    {
        if($role=='member') return $this->storeByRole($request, $role);

        // save registration
        if($request->session()->get("step") == "register"){
            return $this->storeByRole($request, $role);
        }
        
        // Open First Page of registration
        return redirect()->route('register',['role'=>$role]);
    }

    /*
    * Store member information into database
    * Go back after saving data
    *
    * @param  Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    private function storeByRole(Request $request, $role)
    {    

        // Get post datas
        $datas = $request->all();
        
        // Validate type Only
        if($role=='member'){
            $validator = Validator::make($datas, ['type' => 'required|max:100',]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
        }
        
        $default = [
            'name'     => 'required|unique:users,name|max:100',
            'email'    => 'required|unique:users,email|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        switch($role){
            case 'member':
                $type=$request->input('type');
                if($type=='person'){
                    $rules = [
                        'first_name' => 'required|max:100',
                        'last_name'  => 'required|max:100',
                        'country'    => 'required|max:100',
                        'nationality'  => 'required|max:100',
                        'sexe'       => 'required',
                        'civility'  => 'required|max:3',
                    ];
                }else{
                    $rules = [
                        'orga_phone' => 'required|max:100',
                        'orga_mobile_phone' => 'required|max:100',
                        'orga_name'         => 'required|max:100',
                        'orga_registration_number'         => 'required|max:100',
                        'orga_rep_official_registration'         => 'required|max:100',
                        'orga_type'         => 'required',
                        'orga_presentation' => 'nullable|max:1000',
                        'route'        => 'required|max:100',
                        'route_number'        => 'required',
                        'locality'     => 'required|max:100',
                        'postalCode'   => 'required|max:100',
                        'area_level_1' => 'nullable|max:100',
                        'country'      => 'required|max:100',
                        'contact_name'       => 'required|max:100',
                        'contact_phone'       => 'required|max:100',
                        'contact_email'        => 'required|email|max:100',
                    ];

                    if($request->orga_type == 'private' || $request->orga_type == 'mixte'){
                        $rules += ['orga_form' => 'required',];
                    }
    
                    if($request->orga_form == 'other'){
                        $rules += ['define_orga_form' => 'required',];
                    }
    
                    if($request->postal_address_below){
                       $rules += [
                        'adrpost_postal_box'     => 'required|max:100',
                        'adrpost_locality'     => 'required|max:100',
                        'adrpost_postalCode'   => 'required|max:100',
                        'adrpost_area_level_1' => 'nullable|max:100',
                        'adrpost_country'      => 'required|max:100',
                       ];
                    }
                }
                break;
            case 'afa':
                $rules = [
                    'type'         => 'required',
                    'orga_name'         => 'required|max:100',
                    'orga_trading_name'         => 'required|max:100',
                    'orga_abn'         => 'required|digits_between:11,11|numeric',
                    'orga_acn'         => 'nullable|digits_between:9,9|numeric',
                    'orga_license_number'  => 'required|max:100',
                    'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|digits_between:8,8|numeric',
                    'orga_fax'        => 'nullable|max:100',
                    'orga_mobile_phone'        => 'required|digits_between:8,8|numeric',
                    'orga_website'      => 'required|url|max:100',
                    'orga_presentation' => 'max:1000',
                    'orga_operation_state' => 'required',
                    'orga_operation_range' => 'required',

                    'route'        => 'required|max:100',
                    'route_number'        => 'required',

                    'area_level_2' => 'required|max:100',
                    'locality'     => 'required|max:100',
                    'postalCode'   => 'required|integer',
                    'area_level_1' => 'required|max:100',
                    'country'      => 'required',
                    
                    'contact_name'  => 'required|max:100',
                    'contact_email' => 'required|email|max:100',
                    'contact_phone' => 'required|digits_between:8,8|numeric',
                ];

                if($request->postal_address_below){
                    $rules += [
                     'adrpost_postal_box'     => 'required|max:100',
                     'adrpost_locality'      => 'required|max:100',
                     'adrpost_area_level_1' => 'required|max:100',
                     'adrpost_postalCode'   => 'required|max:100',
                    ];
                 }

                 if($request->postal_address_above){
                    $datas['adrpost_locality'] = $datas['locality'];
                    $datas['adrpost_area_level_1'] = $datas['area_level_1'];
                    $datas['adrpost_postalCode'] = $datas['postalCode'];
                 }

                 if(is_array($datas['orga_operation_state'])){
                    $datas['orga_operation_state']=serialize($datas['orga_operation_state']);
                 }

                break;
            case 'apl':
                $rules = [
                    'orga_name'         => 'required|max:100',
                    'orga_registration_number'         => 'required|max:100',
                    'orga_type'         => 'required',
                    'orga_license_number'         => 'required|max:100',
                    'orga_operation_range' => 'required',
                    'orga_presentation' => 'nullable|max:1000',
                    
                    'route'        => 'required|max:100',
                    'route_number'        => 'required',
                    'locality'     => 'required|max:100',
                    'postalCode'   => 'required|max:100',
                    'area_level_1' => 'nullable|max:100',
                    'country'      => 'required|max:100',
                    
                    'contact_name'  => 'required|max:100',
                    'contact_phone' => 'required|max:100',
                    'contact_email' => 'required|email|max:100',

                    'bank_name' => 'required|max:100',
                    'bank_agency' => 'required|max:100',
                    'bank_postal_box' => 'required|max:100',
                    'bank_locality' => 'required|max:100',
                    'bank_postalCode' => 'required|max:100',
                    'bank_country' => 'required|max:100',
                    'bank_iban' => 'required|alpha_num|min:27|max:27',
                    'bank_bic' => 'required|alpha|min:8|max:8',
                ];

                if($request->orga_type == 'society'){
                    $rules += ['orga_form' => 'required',];
                }

                if($request->orga_form == 'other'){
                    $rules += ['orga_form' => 'required',];
                }

                if($request->postal_address_below){
                   $rules += [
                    'adrpost_locality'     => 'required|max:100',
                    'adrpost_postalCode'   => 'required|max:100',
                    'adrpost_area_level_1' => 'nullable|max:100',
                    'adrpost_country'      => 'required|max:100',
                   ];
                }

                if($request->postal_address_above){
                    $datas['adrpost_locality'] = $datas['locality'];
                    $datas['adrpost_postalCode'] = $datas['postalCode'];
                    $datas['adrpost_area_level_1'] = $datas['area_level_1'];
                    $datas['adrpost_country'] = $datas['country'];
                 }

                break;
            case 'seller':

                $rules = [
                    // Même champs
                    'route'        => 'required|max:100',
                    'locality'     => 'required|max:100',
                    'area_level_2' => 'required|max:100',
                    'postalCode'   => 'required|integer',
                    'area_level_1' => 'required|max:100',
                    'country'      => 'required',
                    // Fin Même champs
                ];

                if(session('seller_class')!=='non_professional_natural_persons'){
                    $rules += [
                        'type'     => 'required|max:100',
                        'orga_name'         => 'required|max:100',
                        'orga_trading_name'         => 'required|max:100',
                        'orga_abn'         => 'required|digits_between:11,11|numeric',
                        'orga_acn'         => 'nullable|digits_between:9,9|numeric',
                        'orga_parent_name'         => 'required|max:100',
                        'orga_email'        => 'required|email|max:100',
                        'orga_phone'        => 'required|digits_between:8,8|numeric',
                        'orga_fax'        => 'nullable|max:100',
                        'orga_mobile_phone'        => 'required|digits_between:8,8|numeric',
                        'orga_website'      => 'required|url|max:100',
                        'orga_presentation' => 'max:1000',

                        'route_number'        => 'required',

                        'contact_name'  => 'required|max:100',
                        'contact_email' => 'required|email|max:100',
                        'contact_phone' => 'required|max:100',
    
                    ];
    
                    if($request->postal_address_below){
                        $rules += [
                         'adrpost_postal_box'     => 'required|max:100',
                         'adrpost_locality'     => 'required|max:100',
                         'adrpost_postalCode'   => 'required|max:100',
                         'adrpost_area_level_1' => 'nullable|max:100',
                         'adrpost_country'      => 'required|max:100',
                        ];
                     }
    
                     if($request->postal_address_above){
                        $datas['adrpost_locality'] = $datas['locality'];
                        $datas['adrpost_postalCode'] = $datas['postalCode'];
                        $datas['adrpost_area_level_1'] = $datas['area_level_1'];
                        $datas['adrpost_country'] = $datas['country'];
                     }
                }else{
                    if(session('seller_class')!=='seller_by_afa'){
                        $rules += [
                            'last_name'  => 'required|max:100',
                            'first_name' => 'required|max:100',
                            'date_of_birth' => 'required|max:100',
                            'place_of_birth' => 'required|max:100',
                            'nationality' => 'required|date|max:100',
                        ];
                    }else{
                        $rules += [
                            'login'  => 'required|max:100',
                            'immat' => 'required|max:100',

                            'date_of_birth' => 'required|dmax:100',
                            'place_of_birth' => 'required|date|max:100',
                            'nationality' => 'required|date|max:100',
                        ];

                        if($request->seller_type == 'business'){
                            $rules += [
                                'orga_name' => 'required|max:100',
                                'orga_phone'        => 'required|digits_between:8,8|numeric',
                                'orga_mobile_phone'        => 'required|digits_between:8,8|numeric',
                                'orga_email'        => 'required|email|max:100',
                            ];
                        }else{
                            $rules += [
                                'last_name'  => 'required|max:100',
                                'first_name' => 'required|max:100',
                                'date_of_birth' => 'required|max:100',
                                'place_of_birth' => 'required|max:100',
                                'nationality' => 'required|date|max:100',
                            ];
                        }
                    }
                }

                break;
            default:
                abort(404);
        }

        // Validate request
        $rules = array_merge($default, $rules);

        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create Localization
        $datas['location_id'] = 0;
        if($location = Localisation::create($datas)){
            $datas['location_id'] = $location->id>0?$location->id:0;
        }
        
        // Store image file
        $datas['image_id'] = 0;
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id>0?$image->id:0;
        }
        
        // More info
        $oRole = Role::where('role_initial',$role)->first() ;
        $typeUser = TypeUser::where('type_user_name',$datas['type'])->first() ;
        
        $datas['role'] = isset($oRole) ? $oRole->id : '';
        $datas['password'] = Hash::make($password = str_random(10));
        $datas['activation_code'] = md5(str_random(30).(time()*32));
        $datas['use_default_password'] = 1;
        $datas['type_users_id'] = isset($typeUser) ? $typeUser->id : '';


        try{
                        
            // Create user
            unset($datas['type']);
            $user = User::create($datas);

            // Create user info
            $datas['user_id'] = $user->id;
            if($userInfo = Userinfo::create($datas)){
                unset($datas['user_id']);
            }

            // $request->merge([
            //     'userinfos_id' => $userInfo->id,
            // ]);
            $rqst=$request;
            if($role === 'afa'){
                unset($rqst['orga_operation_state']);
            }
            $user->handles($rqst);
            
        }catch (\Exception $exception) {
            logger()->error($exception);
            return back()->with('info', trans('app.txt.errorcreateuser'));
        }

        $request->session()->forget("step");

        // Notify User
        try{
            $user->notify(new AccountCreated($user, $password));
            
            // forget as role session
            session()->forget('as_role');

        }catch(\Exception $e){}

        // Success
        return redirect()->route('login')
            ->with('success', trans('app.txt.createuser.success').'<br>'
                  .'<a class="btn btn-default" href="'.route('resend_code', $user).'">'.trans('app.txt.resendcode').'</a>');
        
    }

    /*
    * Load country code from csv file
    *
    */
    private function getPaysFromCsv(){
        $ligne = 1;
        $fic = fopen(resource_path()."/csv/country-code-fr.csv", "a+");
        $listePays = array();
        while($tab=fgetcsv($fic,1024))
        {
            $champs = count($tab);
            $ligne ++;
            for($i=0; $i<$champs; $i ++)
            {
                $pays = explode(";", $tab[$i]);
                array_push( $listePays, $pays[1]) ;
            }
        }
        return $listePays;
    }

    /*
    * Load tel code from csv file
    *
    */
    private function getTelsFromCsv(){
        $ligne = 1;
        $fic = fopen(resource_path()."/csv/tel-code-fr.csv" , "a+");
        $listeContact = array();
        while($tab=fgetcsv($fic,1024))
        {
            $champs = count($tab);
            $ligne ++;
            for($i=0; $i<$champs; $i ++)
            {
                $contact = explode(";", $tab[$i]);
                array_push( $listeContact, $contact[0]."  ".$contact[1]) ;
            }
        }
        return $listeContact;
    }
}
