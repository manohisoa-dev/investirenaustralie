<?php

namespace App\Http\Controllers;

use App\Models\Userinfo;
use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;
use Redirect;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Localisation;
use App\Models\Product;
use App\Models\Newsletter;
use App\Models\DossierTransaction;
use App\Mail\MailTemplate;
use App\Models\MailsTemplate;
use App\Models\SellerIndividual;
use App\Models\SellerBusiness;
use App\Notifications\MemberMandateSearchMessage;
use Mail;

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
        $this->middleware('user', ['only' => ['active','temp']]);
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
                    // Update membre particulier restreint
                    $resp = $this->updateMemberPart($request,$user,$role);

                    if($resp[0]['status']===false){
                        return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                    }else{
                        $alert =trans('app.txt.alert_success');
                    }
                }elseif($type==='person_complete'){
                    // Update membre particulier complet
                    return $this->updateMemberPartComplete($request,$user,$role);

                    // if($resp[0]['status']===false){
                    //     return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                    // }else{
                    //     $alert =trans('app.txt.alert_success');
                    // }
                }else{
                    // Update membre organisation
                    $resp = $this->updateMemberOrganization($request,$user,$role);

                    if($resp[0]['status']===false){
                        return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                    }else{
                        $alert =trans('app.txt.alert_success');
                    }
                }
                break;
            case 3: 
                // Update AFA
                $resp = $this->updateAfa($request,$user,$role);

                if($resp[0]['status']===false){
                    return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                }else{
                    $alert =trans('app.txt.alert_success');
                }

                break;
            case 4:  
                // Update APL
                $resp = $this->updateApl($request,$user,$role);

                if($resp[0]['status']===false){
                    return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                }else{
                    $alert =trans('app.txt.alert_success');
                }

                break;
            case 2:  
                $user->TypeUser->type_user_name;
                if($user->TypeUser->type_user_name=='Builder' || $user->TypeUser->type_user_name=='Developer'){
                    // Update Vendeur Real Estate Professionals
                    $resp = $this->updateSellerRep($request,$user,$role);

                    if($resp[0]['status']===false){
                        return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                    }else{
                        $alert =trans('app.txt.alert_success');
                    }
                }else if($user->TypeUser->type_user_name=='Organization'){
                    // Update Vendeur Real Estate Legal Person
                    $resp = $this->updateSellerSlp($request,$user,$role);

                    if($resp[0]['status']===false){
                        return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                    }else{
                        $alert =trans('app.txt.alert_success');
                    }
                }else{
                    if($user->TypeUser->type_user_name=='Person'){
                        // Update Vendeur Real Estate Natural Person
                        $resp = $this->updateSellerSnp($request,$user,$role);

                        if($resp[0]['status']===false){
                            return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                        }else{
                            $alert =trans('app.txt.alert_success');
                        }
                    }else{
                        if(strtolower($user->TypeUser->type_user_name)!=='business'){
                            
                            // Update Seller By Afa Individual
                            $resp = $this->updateSellerSbaIndividual($request,$user,$role);

                            if($resp[0]['status']===false){
                                return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                            }else{
                                $alert =trans('app.txt.alert_success');
                            }
                        }else{
                            
                            // Update Seller By Afa Business 
                            $resp = $this->updateSellerSbaBusiness($request,$user,$role);

                            if($resp[0]['status']===false){
                                return Redirect::back()->withErrors($resp[0]['resp'])->withInput();
                            }else{
                                $alert =trans('app.txt.alert_success');
                            }
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

        // Success
        return back()->with('success',trans('app.txt.profil_modified'));
        
    }

    public function updateMemberPart(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',
            'nationality'  => 'required|max:100',
        ];

        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            // Store image file
            $datas['image_id'] = 0;
            if($file=$request->file('image')){
                $image = Image::storeAndSave($file);
                $datas['image_id'] = $image->id;
            }


            try {
                // Créer user membre
                $users = [
                    'name'=> $datas['name'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                // update userinfo
                $userinfos = [
                    'first_name'=> $datas['first_name'],
                    'last_name'=> $datas['last_name'],
                    'nationality'=> $datas['nationality'],
                    'allow_sharing'=> $datas['allow_sharing'],
                    'newsletter'=> $datas['newsletter'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateMemberPartComplete(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Créer user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                //Créer localisation
                $locations = [
                    'country'=> $datas['country'],
                    'route'=> $datas['route'],
                    'route_number'=> $datas['route_number'],
                    'area_level_2'=> $datas['area_level_2'],
                    'postalCode'=> $datas['postalCode'],
                    'adrphy_country'=> $datas['adrphy_country'],
                    'adrpost_postal_box'=> isset($datas['adrpost_postal_box'])?$datas['adrpost_postal_box']:'',
                    'adrpost_area_level_2'=> isset($datas['adrpost_area_level_2'])?$datas['adrpost_area_level_2']:'',
                    'adrpost_postalCode'=> isset($datas['adrpost_postalCode'])?$datas['adrpost_postalCode']:'',
                    'adrpost_country'=> isset($datas['adrpost_country'])?$datas['adrpost_country']:'',
                ];
                Localisation::whereId($user->location_id)->update($locations);

                // update userinfo
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
                $userinfos = [
                    'civility'=> $datas['civility'],
                    'first_name'=> $datas['first_name'],
                    'last_name'=> $datas['last_name'],
                    'nationality'=> $datas['nationality'],
                    'orga_phone'=> $datas['orga_phone'],
                    'orga_mobile_phone'=> $datas['orga_mobile_phone'],
                    'orga_email'=> $datas['orga_email'],
                    'orga_fb'=> $datas['orga_fb'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

                // redirect after complete registration for member
                if(Session()->get('complete_registration')){
                    $idProd = Session()->get('id_product');
                    $item = Product::whereId($idProd)->first();

                    // envoyé message à l'afa + lien 
                    $dossTrans=DossierTransaction::whereId($request->id_doss)->first();
                    $user=User::whereId($dossTrans->user_id)->first();
                    $user_afa= User::whereId($user->afa->id)->first();
                    $product=Product::whereId($dossTrans->product_id)->first();

                    // get template mail AFA
                    $template = MailsTemplate::where('id', 30)->get();
                    $lang = 'en';
                    App::setLocale($lang);
                    $body = 'template_' . $lang;
                    $sujet_tpl = 'sujet_'.$lang;
                    $path_link='uploads/pdf/transaction/'.$dossTrans->mr_finalize_file_name;
                    $downloadLink = setLinkDynamic($path_link,strtoupper(trans('app.txt.finalized_mandate_form')));
                    $completedtLink = setLinkDynamic(route('afa.transaction'),strtoupper(trans('app.txt.complete_transaction_file_info')));
                    $vars = array(
                        '{date}' => Carbon::now()->toFormattedDateString(),
                        '{heure}' => Carbon::now()->toTimeString(),
                        '{country}' => $product->location->area_level_1,
                        '{name}' => $user->isPerson()?$user->userinfos->first_name.' '.$user->userinfos->last_name:$user->userinfos->orga_name,
                        '{afa}' => $user->afa->name,
                        '{city}' => $product->location->locality,
                        '{completedtLink}' => $completedtLink,
                        '{mrfinalizedLink}' => $downloadLink,
                    );
                    $sujet = $template[0]->$sujet_tpl;
                    $contenu = strtr($template[0]->$body, $vars);
                    $content = ['title' => '', 'body' => $contenu];
                    // $user_afa->notify(new MemberMandateSearchMessage($sujet,$content));
                    Mail::to($user_afa->email)->send(new MailTemplate($content, $sujet));

                    // get template mail Membre
                    // envoyé message au membre pour avertir qu'il doit préciser avec l'afa les caractéristique du bien acheter
                    $template1 = MailsTemplate::where('id', 31)->get();
                    $lang1 = $user->language;
                    $body1 = 'template_' . $lang1;
                    $sujet_tpl1 = 'sujet_'.$lang1;
                    $sujet1 = $template1[0]->$sujet_tpl1;
                    $contenu1 = strtr($template1[0]->$body1, $vars);
                    $content1 = ['title' => '', 'body' => $contenu1];
                    // $user->notify(new MemberMandateSearchMessage($sujet1,$content1));
                    Mail::to($user->email)->send(new MailTemplate($content1, $sujet1));

                    // Update dossier transaction
                    DossierTransaction::whereId($request->id_doss)->update(['status'=>7, 'date_complete_profil'=>Carbon::now()]);

                    return redirect(route('member.transaction'));
                }

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            // return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateMemberOrganization(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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

        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Créer user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                //Créer localisation
                $locations = [
                    'country'=> $datas['country'],
                    'area_level_1'=> $datas['area_level_1'],
                    'postalCode'=> $datas['postalCode'],
                    'num_rooms'=> $datas['num_rooms'],
                    'num_floor'=> $datas['num_floor'],
                    'building_name'=> isset($datas['building_name'])?$datas['building_name']:'',
                    'adrpost_postal_box'=> isset($datas['adrpost_postal_box'])?$datas['adrpost_postal_box']:'',
                    'adrpost_locality'=> isset($datas['adrpost_locality'])?$datas['adrpost_locality']:'',
                    'adrpost_area_level_2'=> isset($datas['adrpost_area_level_2'])?$datas['adrpost_area_level_2']:'',
                    'adrpost_postalCode'=> isset($datas['adrpost_postalCode'])?$datas['adrpost_postalCode']:'',
                    'adrpost_country'=> isset($datas['adrpost_country'])?$datas['adrpost_country']:'',
                ];
                Localisation::whereId($user->location_id)->update($locations);

                // update userinfo
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
                $userinfos = [
                    'orga_phone'=> $datas['orga_phone'],
                    'orga_fax'=> $datas['orga_fax'],
                    'orga_mobile_phone'=> $datas['orga_mobile_phone'],
                    'orga_name'=> $datas['orga_name'],
                    'orga_registration_number'=> $datas['orga_registration_number'],
                    'orga_rep_official_registration'=> $datas['orga_rep_official_registration'],
                    'orga_presentation'=> $datas['orga_presentation'],
                    'contact_name'=> $datas['contact_name'],
                    'contact_phone'=> $datas['contact_phone'],
                    'contact_email'=> $datas['contact_email'],
                    'allow_sharing'=> $datas['allow_sharing'],
                    'newsletter'=> $datas['newsletter'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateAfa(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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
            
            'country'      => 'required',
            'area_level_1' => 'required|max:100',
            'postalCode'   => 'required|integer',
            'contact_name'  => 'required|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_phone' => 'required|digits_between:6,15|numeric',
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

        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Créer user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                //Créer localisation
                $locations = [
                    'country'=> $datas['country'],
                    'area_level_1'=> $datas['area_level_1'],
                    'area_level_2'=> $datas['area_level_2'],
                    'postalCode'=> $datas['postalCode'],
                    'route'=> $datas['route'],
                    'route_number'=> $datas['route_number'],
                    'locality'=> $datas['locality'],
                    'adrpost_postal_box'=> isset($datas['adrpost_postal_box'])?$datas['adrpost_postal_box']:'',
                    'adrpost_locality'=> isset($datas['adrpost_locality'])?$datas['adrpost_locality']:'',
                    'adrpost_postalCode'=> isset($datas['adrpost_postalCode'])?$datas['adrpost_postalCode']:'',
                    'adrpost_area_level_1'=> isset($datas['adrpost_area_level_2'])?$datas['adrpost_area_level_2']:'',
                    'adrpost_country'=> isset($datas['adrpost_country'])?$datas['adrpost_country']:'',
                ];
                Localisation::whereId($user->location_id)->update($locations);

                // update userinfo
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
                $userinfos = [
                    'orga_name'=> $datas['orga_name'],
                    'orga_trading_name'=> $datas['orga_trading_name'],
                    'orga_abn'=> $datas['orga_abn'],
                    'orga_acn'=> $datas['orga_acn'],
                    'orga_license_number'=> $datas['orga_license_number'],
                    'orga_phone'=> $datas['orga_phone'],
                    'orga_fax'=> $datas['orga_fax'],
                    'orga_mobile_phone'=> $datas['orga_mobile_phone'],
                    'orga_website'=> $datas['orga_website'],
                    'orga_presentation'=> $datas['orga_presentation'],
                    'orga_operation_state'=> serialize($datas['orga_operation_state']),
                    'orga_operation_range'=> $datas['orga_operation_range'],
                    'contact_name'=> $datas['contact_name'],
                    'contact_email'=> $datas['contact_email'],
                    'contact_phone'=> $datas['contact_phone'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateApl(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'orga_name'         => 'required|max:100',
            'orga_registration_number'         => 'required|max:100',
            // 'orga_type'         => 'required',
            'orga_license_number'         => 'required|max:100',
            'orga_operation_range' => 'required',
            'orga_presentation' => 'nullable|max:2000',
            'orga_rep_official_registration' => 'nullable|max:2000',

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
             'adrpost_area_level_1' => 'nullable|max:100',
             'adrpost_country'      => 'required|max:100',
            ];
        }

        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Créer user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                //Créer localisation
                $locations = [
                    'route'=> $datas['route'],
                    'building_name'=> $datas['building_name'],
                    'num_rooms'=> $datas['num_rooms'],
                    'num_floor'=> $datas['num_floor'],
                    'route_number'=> $datas['route_number'],
                    'locality'=> $datas['locality'],
                    'postalCode'=> $datas['postalCode'],
                    'area_level_1'=> $datas['area_level_1'],
                    'country'=> $datas['country'],
                    'bank_postal_box'=> $datas['bank_postal_box'],
                    'bank_locality'=> $datas['bank_locality'],
                    'bank_postalCode'=> $datas['bank_postalCode'],
                    'bank_country'=> $datas['bank_country'],
                    'adrpost_postal_box'=> isset($datas['adrpost_postal_box'])?$datas['adrpost_postal_box']:'',
                    'adrpost_locality'=> isset($datas['adrpost_locality'])?$datas['adrpost_locality']:'',
                    'adrpost_postalCode'=> isset($datas['adrpost_postalCode'])?$datas['adrpost_postalCode']:'',
                    'adrpost_area_level_1'=> isset($datas['adrpost_area_level_2'])?$datas['adrpost_area_level_2']:'',
                    'adrpost_country'=> isset($datas['adrpost_country'])?$datas['adrpost_country']:'',
                ];
                Localisation::whereId($user->location_id)->update($locations);

                // update userinfo
                // format phone number userinfos
                if(isset($datas['contact_phone'])){
                    $datas['contact_phone'] = '('.$datas['indicatif2'].')'.$datas['contact_phone'];
                }

                $userinfos = [
                    'contact_name'=> $datas['contact_name'],
                    'contact_phone'=> $datas['contact_phone'],
                    'contact_email'=> $datas['contact_email'],
                    'orga_name'=> $datas['orga_name'],
                    'orga_registration_number'=> $datas['orga_registration_number'],
                    'orga_rep_official_registration'=> $datas['orga_rep_official_registration'],
                    'orga_license_number'=> $datas['orga_license_number'],
                    'orga_operation_range'=> $datas['orga_operation_range'],
                    'orga_presentation'=> $datas['orga_presentation'],
                    'bank_name'=> $datas['bank_name'],
                    'bank_agency'=> $datas['bank_agency'],
                    'bank_iban'=> $datas['bank_iban'],
                    'bank_bic'=> $datas['bank_bic'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateSellerRep(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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

            'building_name'        => 'nullable',
            'route'        => 'required|max:100',
            'num_rooms'        => 'nullable',
            'num_floor'        => 'nullable',
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
                'orga_parent_name'         => 'max:100',
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

        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Créer user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                //Créer localisation
                $locations = [
                    'route'=> $datas['route'],
                    'route_number'=> $datas['route_number'],
                    'locality'=> $datas['locality'],
                    'area_level_2'=> $datas['area_level_2'],
                    'postalCode'=> $datas['postalCode'],
                    'area_level_1'=> $datas['area_level_1'],
                    'num_rooms'=> $datas['num_rooms'],
                    'num_floor'=> $datas['num_floor'],
                    'building_name'=> $datas['building_name'],
                    'country'=> $datas['country'],
                    'adrpost_postal_box'=> isset($datas['adrpost_postal_box'])?$datas['adrpost_postal_box']:'',
                    'adrpost_locality'=> isset($datas['adrpost_locality'])?$datas['adrpost_locality']:'',
                    'adrpost_postalCode'=> isset($datas['adrpost_postalCode'])?$datas['adrpost_postalCode']:'',
                    'adrpost_area_level_1'=> isset($datas['adrpost_area_level_2'])?$datas['adrpost_area_level_2']:'',
                    'adrpost_country'=> isset($datas['adrpost_country'])?$datas['adrpost_country']:'',
                ];
                Localisation::whereId($user->location_id)->update($locations);
                
                // update userinfo
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
                
                $userinfos = [
                    'orga_parent_name'=> isset($datas['orga_parent_name'])?$datas['orga_parent_name']:'',
                    'orga_name'=> $datas['orga_name'],
                    'orga_trading_name'=> $datas['orga_trading_name'],
                    'orga_abn'=> $datas['orga_abn'],
                    'orga_acn'=> $datas['orga_acn'],
                    'orga_phone'=> $datas['orga_phone'],
                    'orga_fax'=> $datas['orga_fax'],
                    'orga_mobile_phone'=> $datas['orga_mobile_phone'],
                    'orga_website'=> $datas['orga_website'],
                    'orga_presentation'=> $datas['orga_presentation'],
                    'contact_name'=> $datas['contact_name'],
                    'contact_phone'=> $datas['contact_phone'],
                    'contact_email'=> $datas['contact_email'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateSellerSlp(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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

            'building_name'        => 'nullable',
            'route'        => 'required|max:100',
            'num_rooms'        => 'nullable',
            'num_floor'        => 'nullable',
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
                'orga_parent_name'         => 'max:100',
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

        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Créer user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                //Créer localisation
                $locations = [
                    'route'=> $datas['route'],
                    'route_number'=> $datas['route_number'],
                    'locality'=> $datas['locality'],
                    'area_level_2'=> $datas['area_level_2'],
                    'postalCode'=> $datas['postalCode'],
                    'area_level_1'=> $datas['area_level_1'],
                    'num_rooms'=> $datas['num_rooms'],
                    'num_floor'=> $datas['num_floor'],
                    'building_name'=> $datas['building_name'],
                    'country'=> $datas['country'],
                    'adrpost_postal_box'=> isset($datas['adrpost_postal_box'])?$datas['adrpost_postal_box']:'',
                    'adrpost_locality'=> isset($datas['adrpost_locality'])?$datas['adrpost_locality']:'',
                    'adrpost_postalCode'=> isset($datas['adrpost_postalCode'])?$datas['adrpost_postalCode']:'',
                    'adrpost_area_level_1'=> isset($datas['adrpost_area_level_2'])?$datas['adrpost_area_level_2']:'',
                    'adrpost_country'=> isset($datas['adrpost_country'])?$datas['adrpost_country']:'',
                ];
                Localisation::whereId($user->location_id)->update($locations);
                
                // update userinfo
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
                
                $userinfos = [
                    'orga_parent_name'=> isset($datas['orga_parent_name'])?$datas['orga_parent_name']:'',
                    'orga_name'=> $datas['orga_name'],
                    'orga_trading_name'=> $datas['orga_trading_name'],
                    'orga_abn'=> $datas['orga_abn'],
                    'orga_acn'=> $datas['orga_acn'],
                    'orga_phone'=> $datas['orga_phone'],
                    'orga_fax'=> $datas['orga_fax'],
                    'orga_mobile_phone'=> $datas['orga_mobile_phone'],
                    'orga_website'=> $datas['orga_website'],
                    'orga_presentation'=> $datas['orga_presentation'],
                    'contact_name'=> $datas['contact_name'],
                    'contact_phone'=> $datas['contact_phone'],
                    'contact_email'=> $datas['contact_email'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateSellerSnp(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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
        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Update user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                //Update localisation
                $locations = [
                    'locality'=> $datas['suburb'],
                    'postalCode'=> $datas['post_code'],
                    'country'=> $datas['country'],
                    'area_level_1'=> $datas['state'],
                    'area_level_1'=> $datas['city'],
                    'route'=> $datas['street_adr'],
                ];
                Localisation::whereId($user->location_id)->update($locations);
                
                // update seller individual
                if(isset($datas['mobile'])){
                    $datas['mobile'] = '('.$datas['indicatif3'].')'.$datas['mobile'];
                }

                if(isset($datas['mobile_2'])){
                    $datas['mobile_2'] = '('.$datas['indicatif3_2'].')'.$datas['mobile_2'];
                }
                
                // Seller #1
                $idSeller= $datas['id_seller'];
                $dtOfbirth = $datas['date_of_birth'];
                $dt = new Carbon($dtOfbirth);
                $dt = $dt->toDateString();
                $sellerIndividuals_1 = [
                    'last_name'=>$datas['last_name'], 
                    'first_name'=>$datas['first_name'], 
                    'date_of_birth'=>$dt, 
                    'place_of_birth'=>$datas['place_of_birth'], 
                    'nationality'=>$datas['nationality'], 
                    'street_adr'=>$datas['street_adr'], 
                    'suburb'=>$datas['suburb'], 
                    'city'=>$datas['city'], 
                    'post_code'=>$datas['post_code'], 
                    'state'=>$datas['state'], 
                    'country'=>$datas['country'], 
                    'mobile'=>$datas['mobile'], 
                    'email_adr'=>$datas['email_adr']
                ];
                SellerIndividual::whereId($idSeller)->update($sellerIndividuals_1);

                // Seller #2
                $idSeller2= $datas['id_seller_2'];
                $dtOfbirth = $datas['date_of_birth_2'];
                $dt = new Carbon($dtOfbirth);
                $dt = $dtOfbirth?$dt->toDateString():'';
                $sellerIndividuals_2 = [
                    'last_name'=>isset($datas['last_name_2'])?$datas['last_name_2']:'', 
                    'first_name'=>isset($datas['first_name_2'])?$datas['first_name_2']:'', 
                    'date_of_birth'=>$dt, 
                    'place_of_birth'=>isset($datas['place_of_birth_2'])?$datas['place_of_birth_2']:'', 
                    'nationality'=>isset($datas['nationality_2'])?$datas['nationality_2']:'', 
                    'street_adr'=>isset($datas['street_adr_2'])?$datas['street_adr_2']:'', 
                    'suburb'=>isset($datas['suburb_2'])?$datas['suburb_2']:'', 
                    'city'=>isset($datas['city_2'])?$datas['city_2']:'', 
                    'post_code'=>isset($datas['post_code_2'])?$datas['post_code_2']:'', 
                    'state'=>isset($datas['state_2'])?$datas['state_2']:'', 
                    'country'=>isset($datas['country_2'])?$datas['country_2']:'', 
                    'mobile'=>isset($datas['mobile_2'])?$datas['mobile_2']:'',
                    'email_adr'=>isset($datas['email_adr_2'])?$datas['email_adr_2']:''
                ];
                SellerIndividual::whereId($idSeller2)->update($sellerIndividuals_2);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateSellerSbaIndividual(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'contact_name'  => 'required|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_phone' => 'required|digits_between:6,9|numeric',

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
        ];
        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Update user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                // update userinfo
                if(isset($datas['contact_phone'])){
                    $datas['contact_phone'] = '('.$datas['indicatif2'].')'.$datas['contact_phone'];
                }
                $userinfos = [
                    'contact_name'=> $datas['contact_name'],
                    'contact_email'=> $datas['contact_email'],
                    'contact_phone'=> $datas['contact_phone'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

                //Update localisation
                $locations = [
                    'locality'=> $datas['suburb'],
                    'postalCode'=> $datas['post_code'],
                    'country'=> $datas['country'],
                    'area_level_1'=> $datas['state'],
                    'area_level_1'=> $datas['city'],
                    'route'=> $datas['street_adr'],
                ];
                Localisation::whereId($user->location_id)->update($locations);
                
                // update seller individual
                if(isset($datas['mobile'])){
                    $datas['mobile'] = '('.$datas['indicatif3'].')'.$datas['mobile'];
                }

                if(isset($datas['mobile_2'])){
                    $datas['mobile_2'] = '('.$datas['indicatif3_2'].')'.$datas['mobile_2'];
                }
                
                // Seller #1
                $idSeller= $datas['id_seller'];
                $sellerIndividuals_1 = [
                    'last_name'=>$datas['last_name'], 
                    'first_name'=>$datas['first_name'], 
                    'street_adr'=>$datas['street_adr'], 
                    'suburb'=>$datas['suburb'], 
                    'city'=>$datas['city'], 
                    'post_code'=>$datas['post_code'], 
                    'state'=>$datas['state'], 
                    'country'=>$datas['country'], 
                    'mobile'=>$datas['mobile'], 
                    'email_adr'=>$datas['email_adr']
                ];
                SellerIndividual::whereId($idSeller)->update($sellerIndividuals_1);

                // Seller #2
                $idSeller2= $datas['id_seller_2'];
                $sellerIndividuals_2 = [
                    'last_name'=>isset($datas['last_name_2'])?$datas['last_name_2']:'', 
                    'first_name'=>isset($datas['first_name_2'])?$datas['first_name_2']:'', 
                    'street_adr'=>isset($datas['street_adr_2'])?$datas['street_adr_2']:'', 
                    'suburb'=>isset($datas['suburb_2'])?isset($datas['suburb_2']):'', 
                    'city'=>isset($datas['city_2'])?isset($datas['city_2']):'', 
                    'post_code'=>isset($datas['post_code_2'])?isset($datas['post_code_2']):'', 
                    'state'=>isset($datas['state_2'])?isset($datas['state_2']):'', 
                    'country'=>isset($datas['country_2'])?isset($datas['country_2']):'', 
                    'mobile'=>isset($datas['mobile_2'])?$datas['mobile_2']:'', 
                    'email_adr'=>isset($datas['email_adr_2'])?$datas['email_adr_2']:''
                ];
                SellerIndividual::whereId($idSeller2)->update($sellerIndividuals_2);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

    }

    public function updateSellerSbaBusiness(Request $request,$user,$role){
        // Get post datas
        $datas = $request->all();

        $rules = [
            'name'     => 'required|max:100',
            'email'    => 'required|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'contact_name'  => 'required|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_phone' => 'required|digits_between:6,9|numeric',

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
        
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return array(['resp'=>$validator,'status'=>false]);
        }else{
            
            try {
                // Store image file
                $datas['image_id'] = 0;
                if($file=$request->file('image')){
                    $image = Image::storeAndSave($file);
                    $datas['image_id'] = $image->id;
                }

                // Update user membre
                $users = [
                    'name'=> $datas['name'],
                    'email'=> $datas['email'],
                    'language'=> $datas['language'],
                    'image_id'=> $datas['image_id'],
                ];
                User::whereId($user->id)->update($users);

                // update userinfo
                if(isset($datas['contact_phone'])){
                    $datas['contact_phone'] = '('.$datas['indicatif2'].')'.$datas['contact_phone'];
                }
                $userinfos = [
                    'contact_name'=> $datas['contact_name'],
                    'contact_email'=> $datas['contact_email'],
                    'contact_phone'=> $datas['contact_phone'],
                ];
                Userinfo::where('user_id',$user->id)->update($userinfos);

                //Update localisation
                $locations = [
                    'locality'=> $datas['suburb'],
                    'postalCode'=> $datas['post_code'],
                    'country'=> $datas['country'],
                    'area_level_1'=> $datas['state'],
                    'area_level_1'=> $datas['city'],
                    'route'=> $datas['street_adr'],
                ];
                Localisation::whereId($user->location_id)->update($locations);
                
                // update seller business
                if(isset($datas['mobile'])){
                    $datas['mobile'] = '('.$datas['indicatif3'].')'.$datas['mobile'];
                }
                if(isset($datas['phone'])){
                    $datas['phone'] = '('.$datas['indicatif'].')'.$datas['phone'];
                }
                
                // Seller #1
                $idSeller= $datas['id_seller'];
                $sellerBusiness = [
                    'business_name'=>$datas['business_name'], 
                    'business_parent'=>$datas['business_parent'], 
                    'street_adr'=>$datas['street_adr'], 
                    'suburb'=>$datas['suburb'], 
                    'city'=>$datas['city'], 
                    'post_code'=>$datas['post_code'], 
                    'state'=>$datas['state'], 
                    'country'=>$datas['country'], 
                    'mobile'=>$datas['mobile'], 
                    'phone'=>$datas['phone'], 
                    'email_adr'=>$datas['email_adr']
                ];
                SellerBusiness::whereId($idSeller)->update($sellerBusiness);

            } catch (\Throwable $th) {
                logger()->error($exception);
                
                return back()->with('info', trans('app.txt.editprofil_unable'));
            }

            return array(['resp'=>$user,'status'=>true]);
        }

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
