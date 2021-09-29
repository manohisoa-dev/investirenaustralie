<?php

namespace App\Http\Controllers;

use App\Models\Userinfo;
use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Localisation;
use App\Models\Product;
use App\Models\Newsletter;

use App\Notifications\AccountCreated;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user:active');
    }

    /**
     * Show current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.profile');
        }else{
            $view = view('backend.user.profile');
        }
        
        return $view->with('title', __('app.profile'))
            ->with('item', Auth::user())
            ->with('breadcrumbs', __('app.profile'));
    }

    /**
     * Show form to edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $action = route('profile.edit');
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.update');
        }else{
            $view = view('backend.user.edit.update');
        }
        $breadcrumbs = [
            [
                'active' => false,
                'route'  => route('profile'),
                'label'  => __('app.profile'),
            ],
            [
                'active' => true,
                'label'  => __('app.profile.edit'),
            ],
            
        ];
        return $view->with('title', __('app.profile'))
            ->with('action', $action)
            ->with('item', Auth::user())
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {    
        $user = Auth::user();
        $role = $user->role;
        $type="";
        
        // Get post datas
        $datas = $request->all();
        
        // Validate type Only
        if($role==5){
            $validator = Validator::make($datas, ['type' => 'required|max:100',]);
            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }
        }
        
        $default = [
            'name'     => 'required|max:100',
            'email'    => 'required|email|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        switch($role){
            case 5:  //Membre
                $type=strtolower($request->input('type'));
                if($type=='person'){
                    $rules = [
                        'nationality' => 'required|max:100',
                        'first_name' => 'required|max:100',
                        'last_name'  => 'required|max:100',
                    ];
                }elseif($type==='person_complete'){
                    $rules = [
                        'country'    => 'required|max:100',
                        'civility'  => 'required|max:3',
                        'last_name'  => 'required|max:100',
                        'first_name' => 'required|max:100',
                        'nationality'  => 'required|max:100',
                        'route'       => 'required',
                        'route_number'       => 'required',
                        'area_level_2' => 'required|max:100',
                        'postalCode'   => 'required|integer',
                        'adrphy_country'      => 'required',
                        'orga_phone'        => 'nullable|digits_between:6,15|numeric',
                        'orga_mobile_phone'        => 'required|digits_between:6,15|numeric',
                        'orga_email'        => 'required|email|max:100',
                        'orga_fb'        => 'nullable|url',
                        'politic'    => 'required',
                        'g-recaptcha-response' => 'required|captcha',
                    ];

                    if($request->postal_address_below || $request->adrpost_postal_box){
                        $rules += [
                         'adrpost_postal_box'     => 'required|max:100',
                         'adrpost_area_level_2' => 'nullable|max:100',
                         'adrpost_postalCode'   => 'required|max:100',
                         'adrpost_country'      => 'required|max:100',
                        ];
                    }

                }else{
                    $rules = [
                        'orga_phone' => 'required|max:100',
                        'orga_fax' => 'nullable|max:100',
                        'orga_mobile_phone' => 'required|max:100',
                        'orga_name'         => 'required|max:100',
                        'orga_registration_number'         => 'required|max:100',
                        'orga_rep_official_registration'         => 'nullable|max:100',
                        // 'orga_type'         => 'required',
                        'orga_presentation' => 'nullable|max:2000',
                        'building_name' => 'nullable',
                        // 'route'        => 'required',
                        // 'route_number'        => 'required',
                        'locality'     => 'required|max:100',
                        'postalCode'   => 'required|max:100',
                        'num_rooms' => 'nullable',
                        'num_floor' => 'nullable',
                        'area_level_1' => 'nullable|max:100',
                        'country'      => 'required|max:100',
                        'contact_name'       => 'required|max:100',
                        'contact_phone'       => 'required|max:100',
                        'contact_email'        => 'required|email|max:100',
                    ];

                    if($request->adrpost_postal_box){
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
            case 3:  //AFA
                $rules = [
                    'orga_name'         => 'required|max:100',
                    'orga_trading_name'         => 'required|max:100',
                    'orga_abn'         => 'required|digits_between:11,11|numeric',
                    'orga_acn'         => 'nullable|digits_between:9,9|numeric',
                    'orga_license_number'  => 'required|max:100',
                    // 'orga_email'        => 'required|email|max:100',
                    'orga_phone'        => 'required|digits_between:6,15|numeric',
                    'orga_fax'        => 'nullable|max:100',
                    'orga_mobile_phone'        => 'required|digits_between:6,15|numeric',
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
                    'contact_phone' => 'required|digits_between:6,15|numeric',

//                    'crm_name'   => 'required|max:100',
//                    'crm_email'  => 'required|max:100',
                ];

                if($request->adrpost_postal_box){
                    $rules += [
                     'adrpost_postal_box'     => 'required|max:100',
                     'adrpost_locality'     => 'required|max:100',
                     'adrpost_postalCode'   => 'required|max:100',
                     'adrpost_area_level_1' => 'required|max:100',
                     'adrpost_country'      => 'required|max:100',
                    ];
                 }
                break;
            case 4:  // APL
                $rules = [
                    'orga_name'         => 'required|max:100',
                    'orga_registration_number'         => 'required|max:100',
                    // 'orga_type'         => 'required',
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
                    'contact_phone' => 'required|digits_between:6,15|numeric',
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
                if($request->adrpost_postal_box){
                    $rules += [
                        'adrpost_postal_box'     => 'required|max:100',
                        'adrpost_locality'     => 'required|max:100',
                        'adrpost_postalCode'   => 'required|max:100',
                        'adrpost_area_level_1' => 'required|max:100',
                        'adrpost_country'      => 'required|max:100',
                    ];
                }
                break;
            case 2:  // Vendeur
                if($user->TypeUser->type_user_name=='Builder' || $user->TypeUser->type_user_name=='Developer'){
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

                        'route'        => 'required|max:100',
                        'route_number'        => 'required',
                        'locality'     => 'required|max:100',
                        'area_level_2' => 'required|max:100',
                        'postalCode'   => 'required|integer',
                        'area_level_1' => 'required|max:100',
                        'country'      => 'required',

                        'contact_name'  => 'required|max:100',
                        'contact_email' => 'required|email|max:100',
                        'contact_phone' => 'required|digits_between:9,9|numeric',
    
                    ];

                    if(isset($request->orga_parent_name)){
                        $rules += [
                            'orga_parent_name'         => 'required|max:100',
                        ];
                    }
    
                    if(isset($request->adrpost_postal_box)){
                        $rules += [
                         'adrpost_postal_box'     => 'required|max:100',
                         'adrpost_locality'     => 'required|max:100',
                         'adrpost_postalCode'   => 'required|max:100',
                         'adrpost_area_level_1' => 'nullable|max:100',
                         'adrpost_country'      => 'required|max:100',
                        ];
                     }
                }else{
                    if($user->TypeUser->type_user_name=='Person'){
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
                            // 'phone' => 'required|digits_between:6,9|numeric',
                            'mobile' => 'required|digits_between:6,9|numeric',
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
                            // 'phone_2' => 'nullable|digits_between:6,9|numeric',
                            'mobile_2' => 'nullable|digits_between:6,9|numeric',
                            'email_adr_2' => 'nullable|email|max:100',

                        ];
                    }else{
                        // type user : individual or business
                        if(strtolower($user->TypeUser->type_user_name)=='business'){
                            $rules = [
                                'business_name' => 'required|max:100',
                                'business_parent' => 'nullable|max:191',
                                'street_adr'        => 'required|max:100',
                                'suburb'        => 'required|max:100',
                                'city'        => 'required|max:100',
                                'post_code' => 'required|max:100',
                                'state' => 'required|max:100',
                                'country' => 'required|max:100',
                                'phone' => 'required|digits_between:6,9|numeric',
                                'mobile' => 'required|digits_between:6,9|numeric',
                                'email_adr' => 'required|email|max:100',
                                'contact_name'  => 'required|max:100',
                                'contact_email' => 'required|email|max:100',
                                'contact_phone' => 'required|digits_between:6,9|numeric',
                            ];
                        }else{
                            // type user individual
                            $rules = [
                                // Seller #1
                                'last_name'  => 'required|max:100',
                                'first_name' => 'required|max:100',
                                'street_adr' => 'required|max:100',
                                'suburb' => 'required|max:100',
                                'city' => 'required|max:100',
                                'post_code' => 'required|max:100',
                                'state' => 'nullable|max:100',
                                'country' => 'required|max:100',
                                'mobile' => 'required|digits_between:6,9|numeric',
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
                                'mobile_2' => 'nullable|digits_between:6,9|numeric',
                                'email_adr_2' => 'nullable|email|max:100',

                                'contact_name'  => 'required|max:100',
                                'contact_email' => 'required|email|max:100',
                                'contact_phone' => 'required|digits_between:6,9|numeric',
                            ];
                        }
                    }
                }
                break;
            case 1:   // Administrateur
                $rules = [
                    'email'    => 'required|unique:users,email|max:100',
                    'language'   => 'required|max:100',
                    'first_name' => 'required|max:100',
                    'last_name'  => 'required|max:100',
                ];
                break;
            default:
                abort(404);
        }

        // Validate request
        if(!$user->isAdmin()){
            $rules = array_merge($default, $rules);
        }
        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        
        if(!$user->isAdmin()){

            // Store image file
            $datas['image_id'] = 0;
            if($file=$request->file('image')){
                $image = Image::storeAndSave($file);
                $datas['image_id'] = $image->id;
            }
        }
        
        try{
            
            // Update user
            if($request->type === 'person_complete'){
                User::whereId($user->id)->update(["is_complete"=> 0]);
            }
            // $user->fill($datas);
            // $user->save();
            
            // Create OR Update MetaData
            $userInfo = Userinfo::where('user_id' , Auth::id())->first() ;

            // format phone number userinfos
            if(isset($datas['contact_phone'])){
                $datas['contact_phone'] = '('.$datas['indicatif2'].')'.$datas['contact_phone'];
            }
            if(isset($datas['orga_mobile_phone'])){
                $datas['orga_mobile_phone'] = '('.$datas['indicatif3'].')'.$datas['orga_mobile_phone'];
            }
            if(isset($datas['orga_phone'])){
                $datas['orga_phone'] = '('.$datas['indicatif'].')'.$datas['orga_phone'];
            }

            // if($userInfo = Userinfo::create($datas)){
            //     unset($datas['user_id']);
            // }

            if(isset($userInfo)){
                $user->handles($request);
            }
            else{
                $userInfo = Userinfo::create(['user_id' => Auth::id()]) ;

                $request->merge([
                    'userinfos_id' => $userInfo->id,
                ]);
                $user->handles($request);
            }

            // update Localisation
            Localisation::updateLocalisation($user->location_id,$datas);

            // redirect after complete registration for member
            if(Session()->get('complete_registration')){
                $idProd = Session()->get('id_product');
                $item = Product::whereId($idProd)->first();
                return redirect(route('member.buy.product', $item));
            }
 
        }catch (\Exception $exception) {
            logger()->error($exception);
            return back()->with('info', trans('app.txt.editprofil_unable'));
        }
    
        // Success
        return back()->with('success',trans('app.txt.profil_modified'));
        
    }

    /**
     * Show form to edit current user password
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {   
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.password');
        }else{
            $view = view('backend.user.edit.password');
        }
        
        $breadcrumbs = [
            [
                'active'=>false,
                'route'=>route('profile'),
                'label'=>__('app.profile'),
            ],
            [
                'active'=>true,
                'label'=>__('app.password'),
            ],
            
        ];
        
        return $view->with('title', __('app.password'))
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show form to edit current user password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'old_password' => 'required|min:8',
                            'password' => 'required|min:8',
                            'password_confirmation' => 'required|min:8|same:password',
                        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator);
        }
        
        $old = $request->old_password;
        if(password_verify($old,Auth::user()->password)){
            Auth::user()->password = bcrypt($request->password);
            Auth::user()->use_default_password = 0;
            Auth::user()->save();
        }else{
            return back()->with('error',trans('app.txt.password_update_error'));
        }
        
        if($request->use_default_password){
            session()->forget('default_password');
        }

        // Logout user
        Auth::logout();

        // Success
        return redirect()->route('login')->with('success',trans('app.txt.password_update'));
    }

    /**
     * Show form to edit current user avatar
     *
     * @return \Illuminate\Http\Response
     */
    public function avatar()
    {
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.avatar');
        }else{
            $view = view('backend.user.edit.avatar');
        }
        
        $breadcrumbs = [
            [
                'active'=>false,
                'route'=>route('profile'),
                'label'=>__('app.profile'),
            ],
            [
                'active'=>true,
                'label'=>__('app.avatar'),
            ],
            
        ];
        return $view->with('title', __('app.avatar'))
            ->with('item', Auth::user())
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show form to edit current user avatar
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $user = Auth::user();
        try{
            $file = $request->file('image');
            $image = Image::storeAndSave($file);
            $user->image_id = $image->id;
            $user->save();
        }catch(\Exception $e){
            return back()->with('success', $e->getMessage());
        }
        
        // Success
        return back()->with('success',trans('app.txt.avatar_update'));
    }

    /**
     * Show form to edit current user location
     *
     * @return \Illuminate\Http\Response
     */
    public function location()
    {
        if(Auth::user()->isAdmin()){
            $view = view('admin.user.edit.location');
        }else{
            $view = view('backend.user.edit.location');
        }
        
        $breadcrumbs = [
            [
                'active'=>false,
                'route'=>route('profile'),
                'label'=>__('app.profile'),
            ],
            [
                'active'=>true,
                'label'=>__('app.location'),
            ],
            
        ];
        return $view->with('title', __('app.location'))
            ->with('item', Auth::user()->with('location'))
            ->with('location',  Auth::user()->location)
            ->with('breadcrumbs',  $breadcrumbs);
    }

    /**
     * Show form to edit current user location
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLocation(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(),[ 
            'latitude'     => 'required',
            'longitude'    => 'required',
            'country'      => 'max:100',
            'area_level_1' => 'max:100',
            'area_level_2' => 'max:100',
            'locality'     => 'max:100',
            'route'       => 'max:100',
            'formatted'    => 'max:100',
            'postalCode'   => 'max:100',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $user = Auth::user();
        
        // Create Localization
        $datas = $request->all();
        if($location = $user->location){
            
            $location->fill($datas);
            
            // Success
            return back()->with('success',trans('app.txt.location_update'));
        }else if($location = Localisation::create($datas)){
            $user->location_id = $location->id>0?$location->id:0;
        }
        
        try{
            $user->save();
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
        // Success
        return back()->with('success',trans('app.txt.location_added'));
    }

    public function ajaxDeleteAccount(Request $request) {
        User::where('id', $request->user_id)->update(['status' => 'deleted']);

        return response()->json(['success' => 'true']);
    }

}
