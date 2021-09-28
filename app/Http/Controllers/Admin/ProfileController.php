<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Localisation;

use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class ProfileController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::user()->isAdmin() || Auth::user()->isAdminBlog() || Auth::user()->isAdminDelegate()) {
            $view = view('admin.user.profile');
        }else {
            $view = view('backend.user.profile');
        }

        return 
        $view->with('title', __('app.profile'))
        ->with('item', Auth::user())
        ->with('location',Auth::user()->location)
        ->with('breadcrumbs', __('app.profile'));
    }

    /**
     * Show form to edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile() {
        $action = route('admin.profile.info');

        if (Auth::user()->isAdmin()) {
            $view = view('admin.user.edit.update');
        } else {
            $view = view('backend.user.edit.update');
        }
        $breadcrumbs = [['active' => false, 'route' => route('admin.profile'), 'label' =>
            __('app.profile'), ], ['active' => true, 'label' => __('app.profile.edit'), ], ];
        return $view->with('title', __('app.profile'))->with('action', $action)->with('item',
            Auth::user())->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request) {
        $user = Auth::user();
        $role = $user->role;
        // Get post datas
        $datas = $request->all();
        // Validate type Only
        if ($role == 'member') {
            $validator = Validator::make($datas, ['type' => 'required|max:100', ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }

        $default = ['name' => 'required|unique:users,name|max:100', 'email' =>
            'required|unique:users,email,' . $user->id . '|max:100', 'language' =>
            'required|max:100', 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', ];

        switch ($role) {
            case 5:
                $type = $request->input('type');
                if ($type == 'person') {
                    $rules = ['first_name' => 'required|max:100', 'last_name' => 'required|max:100', ];
                } else {
                    $rules = ['prefixPhone' => 'required|max:100', 'phone' => 'required|max:100',
                        'orga_name' => 'required|max:100', 'orga_presentation' => 'required|max:2000', ];
                }
                break;
            case 4:
                $rules = ['orga_name' => 'required|max:100', 'orga_presentation' =>
                    'required|max:2000', 'orga_email' => 'required|unique:users,email,' . $user->id .
                    '|max:100', 'orga_phone' => 'required|max:100', 'orga_website' =>
                    'required|url|max:100', 'orga_operation_range' => 'required|max:100',
                    'contact_name' => 'required|max:100', 'contact_email' =>
                    'required|unique:users,email,' . $user->id . '|max:100', 'contact_phone' =>
                    'required|max:100', 'bank_iban' => 'max:100', 'bank_bic' => 'max:100', ];
                break;
            case 3:
                $rules = ['orga_name' => 'required|max:100', 'orga_presentation' =>
                    'required|max:2000', 'orga_email' => 'required|unique:users,email,' . $user->id .
                    '|max:100', 'orga_phone' => 'required|max:100', 'orga_website' =>
                    'required|url|max:100', 'orga_operation_state' => 'required|max:100',
                    'orga_operation_range' => 'required|max:100', 'contact_name' =>
                        'required|max:100', 'contact_email' => 'required|max:100', 'contact_phone' =>
                        'required|max:100', 'crm_name' => 'required|max:100', 'crm_email' =>
                        'required|max:100', ];
                break;
            case 2:
                $rules = ['orga_name' => 'required|max:100', 'orga_presentation' =>
                    'required|max:2000', 'orga_email' => 'required|unique:users,email,' . $user->id .
                    '|max:100', 'orga_phone' => 'required|max:100', 'orga_website' =>
                    'required|url|max:100', 'contact_name' => 'required|max:100', 'contact_email' =>
                    'required|max:100', 'contact_phone' => 'required|max:100', 'crm_name' =>
                    'required|max:100', 'crm_email' => 'required|max:100', ];
                break;
            case 1:
                $rules = ['email' => 'required|unique:users,email,' . $user->id . '|max:100',
                    'language' => 'required|max:100', 'first_name' => 'required|max:100',
                    'last_name' => 'required|max:100', ];
                break;
            default:
                abort(404);
        }

        // Validate request
        if (!$user->isAdmin()) {
            $rules = array_merge($default, $rules);
        }

        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store image file
        //$datas['image_id'] = 0;
        if ($file = $request->file('image')) {
            $image = Image::storeAndSave($file);
            $datas['image_id'] = $image->id;
        }

        /*if(!$user->isAdmin()){
        // Store image file
        $datas['image_id'] = 0;
        if($file=$request->file('image')){
        $image = Image::storeAndSave($file);
        $datas['image_id'] = $image->id;
        }
        }*/

        try {
            // Update user
            $user->fill($datas);
            $user->save();
            // Create OR Update MetaData
            $user->handles($request);

        }
        catch (\Exception $exception) {
            logger()->error($exception);
            Notify::error('Unable to edit your profile');
            return back();
        }

        // Success
        Notify::success('Votre profile a été bien modifié.');
        return back();

    }

    /**
     * Show form to edit current user password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request) {
        // Validate request
        $validator = Validator::make($request->all(), ['old_password' =>
            'required|max:100', 'password' => 'confirmed|max:100', ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $old = bcrypt($request->old_password);
        if ($old == Auth::user()->password) {
            Auth::user()->password = bcrypt($request->password);
            Auth::user()->use_default_password = 0;
        }

        // Success
        Notify::success('Votre mot de passe a été bien modifié.');
        return back();
    }

    /**
     * Show form to edit current user location
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLocation(Request $request) {
        // Validate request
        $validator = Validator::make($request->all(), ['latitude' => 'required',
            'longitude' => 'required', 'country' => 'max:100', 'area_level_1' => 'max:100',
            'area_level_2' => 'max:100', 'locality' => 'max:100', 'route' => 'max:100',
            'formatted' => 'max:100', 'postalCode' => 'max:100', ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Create Localization
        $datas = $request->all();
        if ($location = $user->location) {

            $location->fill($datas);

            // Success
            Notify::success('Votre location a été bien modifiée.');
            return back();
        } else
            if ($location = Localisation::create($datas)) {
                $user->location_id = $location->id > 0 ? $location->id : 0;
            }
        try {
            $user->save();
        }
        catch (\Exception $e) {
            Notify::error($e->getMessage());
            return back();
        }

        // Success
        Notify::success('Votre location a été bien ajoutée.');
        return back();
    }

}
