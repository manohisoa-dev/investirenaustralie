<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Event;
use App;
use DB;

use App\Notifications\AccountCreated;
use App\Notifications\ConfirmRegistrationMemberMessage;
use App\Notifications\RegistrationConfirmedMessage;
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
use App\Models\SellerBusiness;
use App\Models\SellerIndividual;
use Carbon\Carbon;
use Session;
use App\Models\Newsletter;

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
        $this->middleware('guest' || 'auth');
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
            'password' => 'required|string|min:8|confirmed',
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
        // Member
        if($user->hasRole(5)){
            $confirmLink = url(route('confirm.registration',[$user,$password]));
            $user->notify(new ConfirmRegistrationMemberMessage($user, $confirmLink));
            // $user->notify(new AccountCreated($user, $password));
        }else{
            $user->notify(new AccountCreated($user, $password));
        }
        
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
        
        switch($role){
            case "member":
                $pays = $this->getPaysFromCsv();
                $tels = $this->getTelsFromCsv();
                return view('login.'.$role)
                    ->with('role', $roles)
                    ->with('action', $action)
                    ->with('countries', Country::all())
                    ->with('page', $page);
                break;
            case "afa":
                App::setLocale('en');
                $request->session()->put("step", "condition");
                return view('login.condition.afa')
                    ->with('role', $roles)
                    ->with('page', $page);
                break;
            case "apl":
                $request->session()->put("step", "condition");
                return view('login.condition.apl')
                    ->with('role', $roles)
                    ->with('page', $page);
                break;
            case "seller":
                App::setLocale('en');
                $request->session()->put("step", "condition");

                if($request->get('class')){
                    session()->forget('afa_id');
                    session()->forget('afa_name');
                    
                    return view('login.condition.sellerbyafa')
                        ->with('role', $roles)
                        ->with('page', $page);
                }else{
                    return view('login.condition.seller')
                        ->with('role', $roles)
                        ->with('page', $page);
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
        $action = route('register',['role'=>$role]);

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
                    $conditionCount = 4;
                }else{
                    $view = view('login.sellerbyafa');
                    $conditionCount = 4;
                }
            break;
        }

        // Shown register form
        if($request->session()->get("step") === "condition"){
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

            // if(session('seller_class'))

            return $view
                    ->with('action', $action)
                    ->with('role', trans('app.'.$role))
                    ->with('states', State::all())
                    ->with('countries', Country::all());
            
        }else{
            return $view
                    ->with('action', $action)
                    ->with('role', trans('app.'.$role))
                    ->with('states', State::all())
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
                        'g-recaptcha-response' => 'required|captcha',
                    ];
                }else{
                    $rules = [
                        'orga_phone' => 'required|max:100',
                        'orga_mobile_phone' => 'required|max:100',
                        'orga_name'         => 'required|max:100',
                        'orga_registration_number'         => 'required|max:100',
                        'orga_rep_official_registration'         => 'nullable|max:100',
                        'orga_type'         => 'required',
                        'orga_presentation' => 'nullable|max:2000',
                        'route'        => 'required|max:100',
                        'route_number'        => 'required',
                        'locality'     => 'required|max:100',
                        'postalCode'   => 'required|max:100',
                        'area_level_1' => 'nullable|max:100',
                        'country'      => 'required|max:100',
                        'contact_name'       => 'required|max:100',
                        'contact_phone'       => 'required|max:100',
                        'contact_email'        => 'required|email|max:100',
                        'g-recaptcha-response' => 'required|captcha',
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
                if($request->newsletter == 'yes'){
                    $newletter = new Newsletter;
                    $newletter->email_adresse = $request->email;
                    $newletter->statuts = 'Actif';
                    $newletter->save();
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
                    // 'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|digits_between:8,9|numeric',
                    'orga_fax'        => 'nullable|max:100',
                    'orga_mobile_phone'        => 'required|digits_between:9,9|numeric',
                    'orga_website'      => 'required|url|max:100',
                    'orga_presentation' => 'max:2000',
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
                    'contact_phone' => 'required|digits_between:9,9|numeric',
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
                    'orga_presentation' => 'nullable|max:2000',
                    
                    'route'        => 'required|max:100',
                    'route_number'        => 'required',
                    'locality'     => 'required|max:100',
                    'postalCode'   => 'required|max:100',
                    'area_level_1' => 'nullable|max:100',
                    'country'      => 'required|max:100',
                    
                    'contact_name'  => 'required|max:100',
                    'contact_phone' => 'required|digits_between:6,9|numeric',
                    'contact_email' => 'required|email|max:100',

                    'bank_name' => 'required|max:100',
                    'bank_agency' => 'required|max:100',
                    'bank_postal_box' => 'required|max:100',
                    'bank_locality' => 'required|max:100',
                    'bank_postalCode' => 'required|max:100',
                    'bank_country' => 'required|max:100',
                    'bank_iban' => 'required|alpha_num|min:27|max:27',
                    'bank_bic' => 'required|alpha_num|min:8|max:11',
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
                if(session('seller_class')!=='non_professional_natural_persons' && session('seller_class')!=='seller_by_afa'){
                    $rules = [
                        'orga_name'         => 'required|max:100',
                        'orga_trading_name'         => 'required|max:100',
                        'orga_abn'         => 'required|digits_between:11,11|numeric',
                        'orga_acn'         => 'nullable|digits_between:9,9|numeric',
                        // 'orga_email'        => 'required|email|max:100',
                        'orga_phone'        => 'required|digits_between:8,9|numeric',
                        'orga_fax'        => 'nullable|max:100',
                        'orga_mobile_phone'        => 'required|digits_between:9,9|numeric',
                        'orga_website'      => 'required|url|max:100',
                        'orga_presentation' => 'max:2000',

                        'route_number'        => 'required',
                        'route'        => 'required|max:100',
                        'locality'     => 'required|max:100',
                        'area_level_2' => 'required|max:100',
                        'postalCode'   => 'required|integer',
                        'area_level_1' => 'required|max:100',
                        'country'      => 'required',

                        'contact_name'  => 'required|max:100',
                        'contact_email' => 'required|email|max:100',
                        'contact_phone' => 'required|digits_between:9,9|numeric',
    
                    ];

                    if(session('seller_class')==='real_estate_professionals'){
                        $rules += [
                            'type'     => 'required|max:100',
                            'orga_parent_name'         => 'required|max:100',
                        ];
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
    
                     if($request->postal_address_above){
                        $datas['adrpost_locality'] = $datas['locality'];
                        $datas['adrpost_postalCode'] = $datas['postalCode'];
                        $datas['adrpost_area_level_1'] = $datas['area_level_1'];
                        $datas['adrpost_country'] = $datas['country'];
                     }
                }else{
                    if(session('seller_class')!=='seller_by_afa'){
                        $rules = [
                            // Seller #1
                            'last_name'  => 'required|max:100',
                            'first_name' => 'required|max:100',
                            'date_of_birth' => 'required|max:100',
                            'place_of_birth' => 'required|max:100',
                            'nationality' => 'required|max:100',
                            'street_adr' => 'required|max:100',
                            'suburb' => 'required|max:100',
                            'city' => 'required|max:100',
                            'post_code' => 'required|max:100',
                            'state' => 'nullable|max:100',
                            'country' => 'required|max:100',
                            // 'phone' => 'required|max:15',
                            'mobile' => 'required|digits_between:6,15|numeric',
                            'email_adr' => 'required|email|max:100',

                            // Seller #2
                            'last_name_2'  => 'nullable|max:100',
                            'first_name_2' => 'nullable|max:100',
                            'date_of_birth_2' => 'nullable|max:100',
                            'place_of_birth_2' => 'nullable|max:100',
                            'nationality_2' => 'nullable|max:100',
                            'street_adr_2' => 'nullable|max:100',
                            'suburb_2' => 'nullable|max:100',
                            'city_2' => 'nullable|max:100',
                            'post_code_2' => 'nullable|max:100',
                            'state_2' => 'nullable|max:100',
                            'country_2' => 'nullable|max:100',
                            // 'phone_2' => 'nullable|max:15',
                            'mobile_2' => 'nullable|digits_between:9,15|numeric',
                            'email_adr_2' => 'nullable|email|max:100',

                        ];
                    }else{
                        $rules = [
                            'login_afa'  => 'required',
                            'immat_afa' => 'required',
                            'property_name'  => 'required',
                            'contact_name'  => 'required|max:100',
                            'contact_email' => 'required|email|max:100',
                            'contact_phone' => 'required|digits_between:6,9|numeric',
                        ];

                        if($request->type == 'business'){
                            $rules += [
                                'business_name' => 'required|max:100',
                                'business_parent' => 'nullable|max:191',
                                'street_adr_bs'        => 'required|max:100',
                                'suburb_bs'        => 'required|max:100',
                                'city_bs'        => 'required|max:100',
                                'post_code_bs' => 'required|max:100',
                                'state_bs' => 'required|max:100',
                                'country_bs' => 'required|max:100',
                                'phone_bs' => 'required|max:15',
                                'mobile_bs' => 'required|max:15',
                                'email_adr_bs' => 'required|email|max:100',
                            ];
                        }else{
                            
                            $rules += [
                                // Seller #1
                                'last_name'  => 'required|max:100',
                                'first_name' => 'required|max:100',
                                'street_adr' => 'required|max:100',
                                'suburb' => 'required|max:100',
                                'city' => 'required|max:100',
                                'post_code' => 'required|max:100',
                                'state' => 'nullable|max:100',
                                'country' => 'required|max:100',
                                'mobile' => 'required|digits_between:6,15|numeric',
                                'email_adr' => 'required|email|max:100',

                                // Seller #2
                                'last_name_2'  => 'nullable|max:100',
                                'first_name_2' => 'nullable|max:100',
                                'street_adr_2' => 'nullable|max:100',
                                'suburb_2' => 'nullable|max:100',
                                'city_2' => 'nullable|max:100',
                                'post_code_2' => 'nullable|max:100',
                                'state_2' => 'nullable|max:100',
                                'country_2' => 'nullable|max:100',
                                'mobile_2' => 'nullable|digits_between:6,15|numeric',
                                'email_adr_2' => 'nullable|email|max:100',
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
            $type= $datas['type'];

            // generate immatriculation user
            $datas['immat'] = $this->generateImmat($role,$type);

            // Set User is seller
            if($role === 'seller'){
                $datas['is_seller'] = 1;
            }

            unset($datas['type']);
            $user = User::create($datas);
            $user->save();
            $datas['user_id'] = $user->id;

            // Create user info
            if($role !== 'seller' || session('seller_class')!=='non_professional_natural_persons' && session('seller_class')!=='seller_by_afa'){
                if(session('seller_class')){
                    if(session('seller_class')!=='real_estate_professionals'){
                        $indicatif = '('.$datas['indicatif'].')';
                    }else{
                        $indicatif = '(+61)';
                    }
                }else{
                    $indicatif = '(+61)';
                }
                
                
                if(isset($datas['contact_phone'])){
                    $datas['contact_phone'] = $indicatif.$datas['contact_phone'];
                }
                if(isset($datas['orga_mobile_phone'])){
                    $datas['orga_mobile_phone'] = $indicatif.$datas['orga_mobile_phone'];
                }
                if(isset($datas['orga_phone'])){
                    $datas['orga_phone'] = $indicatif.$datas['orga_phone'];
                }

                if($userInfo = Userinfo::create($datas)){
                    unset($datas['user_id']);
                }
            }

            // $request->merge([
            //     'userinfos_id' => $userInfo->id,
            // ]);
            $rqst=$request;
            if($role === 'afa'){
                unset($rqst['orga_operation_state']);
            }
            $user->handles($rqst);

            // Save info in seller_individual or seller_business table where registrator is seller non professional natural persons or seller by afa
            if($role == 'seller'){
                if(session('seller_class') == 'non_professional_natural_persons' || (session('seller_class') == 'seller_by_afa' && $type == 'individual' )){
                    if(session('seller_class')!=='seller_by_afa'){
                        $dtOfbirth = $datas['date_of_birth'];
                        $dt = new Carbon($dtOfbirth);
                        $dt = $dt->toDateString();
                    }else{
                        $dt ="";
                    }
                    $ausInd = '(+61)';
        
                    $si= SellerIndividual::create([
                        'user_id'=>$user->id, 
                        'last_name'=>$datas['last_name'], 
                        'first_name'=>$datas['first_name'], 
                        'date_of_birth'=>$dt, 
                        'place_of_birth'=>session('seller_class')!=='seller_by_afa'?$datas['place_of_birth']:'', 
                        'nationality'=>session('seller_class')!=='seller_by_afa'?$datas['nationality']:'', 
                        'street_adr'=>$datas['street_adr'], 
                        'suburb'=>$datas['suburb'], 
                        'city'=>$datas['city'], 
                        'post_code'=>$datas['post_code'], 
                        'state'=>$datas['state'], 
                        'country'=>$datas['country'], 
                        // 'phone'=>$ausInd.$datas['phone'], 
                        'mobile'=>$ausInd.$datas['mobile'], 
                        'email_adr'=>$datas['email_adr']
                    ]);

                    $si2= SellerIndividual::create([
                        'user_id'=>$user->id, 
                        'last_name'=>isset($datas['last_name_2'])?$datas['last_name_2']:'', 
                        'first_name'=>isset($datas['first_name_2'])?$datas['first_name_2']:'', 
                        'date_of_birth'=>isset($datas['date_of_birth_2'])?(new Carbon($datas['date_of_birth_2']))->toDateString():'', 
                        'place_of_birth'=>isset($datas['place_of_birth_2'])?(session('seller_class')!=='seller_by_afa'?$datas['place_of_birth_2']:''):'', 
                        'nationality'=>isset($datas['nationality_2'])?(session('seller_class')!=='seller_by_afa'?$datas['nationality_2']:''):'', 
                        'street_adr'=>isset($datas['street_adr_2'])?$datas['street_adr_2']:'', 
                        'suburb'=>isset($datas['suburb_2'])?$datas['suburb_2']:'', 
                        'city'=>isset($datas['city_2'])?$datas['city_2']:'', 
                        'post_code'=>isset($datas['post_code_2'])?$datas['post_code_2']:'', 
                        'state'=>isset($datas['state_2'])?$datas['state_2']:'', 
                        'country'=>isset($datas['country_2'])?$datas['country_2']:'', 
                        // 'phone'=>isset($datas['phone_2'])?$ausInd.$datas['phone_2']:'', 
                        'mobile'=>isset($datas['mobile_2'])?$ausInd.$datas['mobile_2']:'', 
                        'email_adr'=>isset($datas['email_adr_2'])?$datas['email_adr_2']:''
                    ]);
                }else{
                    if($type == 'business'){
                        $sb = SellerBusiness::create([
                            'user_id'=>$user->id, 
                            'business_name'=>$datas['business_name'], 
                            'business_parent'=>$datas['business_parent'], 
                            'street_adr'=>$datas['street_adr_bs'], 
                            'suburb'=>$datas['suburb_bs'], 
                            'city'=>$datas['city_bs'], 
                            'post_code'=>$datas['post_code_bs'], 
                            'state'=>$datas['state_bs'], 
                            'country'=>$datas['country_bs'], 
                            'phone'=>$datas['phone_bs'], 
                            'mobile'=>$datas['mobile_bs'], 
                            'email_adr'=>$datas['email_adr_bs']
                        ]);
                    }
                }
            }
            
        }catch (\Exception $exception) {
            logger()->error($exception);
            // remove user created if error
            DB::table('users')->where('id', $user->id)->delete();
            DB::table('localizations')->where('id', $location->id)->delete();
            return back()->with('info', trans('app.txt.errorcreateuser'));
        }

        $request->session()->forget("step");

        // Notify User
        try{
            // Member
            if($user->hasRole(5)){
                $confirmLink = url(route('confirm.registration',[$user,$password]));
                $user->notify(new ConfirmRegistrationMemberMessage($user, $confirmLink));
                // $user->notify(new AccountCreated($user, $password));
            }else{
                $user->notify(new AccountCreated($user, $password));
            }
            
            // forget as role session
            session()->forget('as_role');

        }catch(\Exception $e){}

        // Success
        return redirect()->route('login')
            ->with('success', trans('app.txt.createuser.success').'<br>'
                  .'<a class="btn btn-default" href="'.route('resend_code', $user).'">'.trans('app.txt.resendcode').'</a>')
            ->with('alert_success',trans('app.txt.alert_success'));
        
    }

    /*
    * Confirm registration Member
    *
    */
    public function confirmRegistration(User $user,$password)
    {   
        // Active user
        $user->status = 'active';
        $user->activation_code = null;
        $user->trial_ends_at = \Carbon\Carbon::now()->addDays(option('payment.trial_delay', 14));
        $user->save();

        // Role is member
        if($user->hasRole(5)){
            $user->notify(new RegistrationConfirmedMessage($user,$password));
        }

        return redirect()->route('login')
                ->with('success',trans('app.txt.accountactivated'));
    }

    /*
    * Generate user immat
    *
    */
    private function generateImmat($role,$type){
        $immatPrefix = "";
        $immatNum = 00000;
        $roleId=0;

        switch($role){
            case 'member':
                $roleId=5;
                $immatPrefix = 'MEM-';

                break;
            case 'afa':
                $roleId=3;
                $immatPrefix = 'AFA-';

                break;
            case 'apl':
                $roleId=4;
                $immatPrefix = 'APL-';

                break;
            case 'seller':
                $roleId=2;
                if(session('seller_class')=='non_professional_natural_persons'){
                    $immatPrefix = 'SNP-';
                }elseif(session('seller_class')=='seller_by_afa'){
                    $immatPrefix = 'SBA-';
                }elseif(session('seller_class')=='non_professional_legal_persons'){
                    $immatPrefix = 'SLP-';
                }else{
                    if($type == 'builder'){
                        $immatPrefix = 'SBU-';
                    }else{
                        $immatPrefix = 'SDE-';
                    }
                }

                break;
            default:
                abort(404);
        }
        
        $userMax = User::where('role',$roleId)->where('immat', 'like', '%'.$immatPrefix.'%')->orderBy('immat','DESC')->first();

        if($userMax !== null){
            $userImmat = $userMax->immat;
            $explodeImmat = explode('-',$userImmat);
            $immatNum = $explodeImmat[1];
        }

        return $immatPrefix . str_pad($immatNum+1, 5, "0", STR_PAD_LEFT);
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
    * Check if user name is taken
    *
    */
    public function ajaxCheckLogin(Request $request) {
        $name = $request->name;
        $name_exist = User::where('name', $name)->get();
        if (count($name_exist) > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }

    /*
    * Check if user password is correct
    *
    */
    public function ajaxCheckPassword(Request $request) {
        $pwd = $request->pwd;
        $userId = $request->user_id;
        $user = User::whereId($userId)->first();
        $hash = Hash::check($pwd, $user->password, []);

        if ($hash) {
            echo "true";
        } else {
            echo "false";
        }
    }

    /*
    * Check if user email is taken
    *
    */
    public function ajaxCheckEmail(Request $request) {
        $email = $request->email;
        $email_exist = User::where('email', $email)->get();
        if (count($email_exist) > 0) {
            echo "false";
        } else {
            echo "true";
        }
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
