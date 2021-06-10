<?php

namespace App\Http\Controllers\Auth;

use App\Models\Localisation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AccountCreated;
use App\Notifications\NotifyAdmin;
use App\Notifications\NotifyUserDisabled;
use Session;
use Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Where to redirect users after login.
     *
     * return @var string
     */
    protected function redirectTo()
    {
        Auth::check();
        Session::put('page_locale',app()->getLocale());
        Session::put('locale',Auth::user()->language);
        Session::save();
        
        if(Auth::user()->use_default_password==1){
            return '/profile/password';
        }

        if(Session('comment')!==null || Session('login_service')!==null){
            return url(url()->previous());
        }

        return '/'. Role::find(Auth::user()->role)->role_initial;
    }
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {

        $latitude = option(\App\Models\Config::$APP_LATITUDE, -25.647467468105795);
        $longitude = option(\App\Models\Config::$APP_LONGITUDE, 146.89921517372136);
        
        $locale = \App::getLocale();
        $title = \App\Models\Config::login()->get_meta_array('title', $locale, __('app.connexion'));
        $content = \App\Models\Config::login()->get_meta_array('content', $locale);
        $address = \App\Models\Config::login()->get_meta_array('address', $locale);
        $contact = \App\Models\Config::login()->get_meta_array('contact', $locale);
        $lapls = Localisation::select('localizations.*')
                ->join('users','users.location_id','=','localizations.id')
                ->where('users.role','=','4')
                ->groupBy('localizations.locality')
                ->get();
        
        return view('auth.login')
            ->with('latitude', $latitude)
            ->with('longitude', $longitude)
            ->with('title', $title)
            ->with('content', $content)
            ->with('address', $address)
            ->with('contact', $contact)
            ->with('lapls', $lapls);
    }
    
    

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {   

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        /*
        * Method 2: Login Active user only
        */
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
            
            // Make sure the user is active
            if ($user->active() && $this->attemptLogin($request)) {
                // Send the normal successful login response
                return $this->sendLoginResponse($request);
            } else {
                
                // Increment the failed login attempts and redirect back to the
                // login form with an error message.
                $this->incrementLoginAttempts($request);
                
                if($user->status == 'disabled'){
                    // $password = str_random(10);
                    // $user->password = bcrypt($password);
                    // $user->activation_code = md5(str_random(30).(time()*32));
                    // $user->save();
                    
                    // Notify Admin
                    $admin = User::where('role',1)->first();
                    $admin->notify(new NotifyAdmin($admin, $user, trans('mail.suspended.user.logged')));

                    // Notify User
                    $user->notify(new NotifyUserDisabled($user, $admin->email));

                    return redirect()
                        ->route('login')
                        ->withInput($request->only($this->username(), 'remember'))
                        ->with('error', trans('app.txt.accountdesactivated'));
                }
                
                return redirect()
                    ->route('login')
                    ->withInput($request->only($this->username(), 'remember'))
                    ->with('error', trans('app.txt.mustconfirmaccount'));
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        // set remember me expire time ~ 3 months
        $rememberTokenExpireMinutes = 131400;

        // first we need to get the "remember me" cookie's key, this key is generate by laravel randomly
        // it looks like: remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d
        $rememberTokenName = Auth::getRecallerName();

        // reset that cookie's expire time
        Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), $rememberTokenExpireMinutes);


        // the code below is just copy from AuthenticatesUsers
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        // return $this->authenticated($request, $this->guard()->user())
        //     ?: redirect()->intended($this->redirectPath());
        
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $link="/";
        $page_locale= Session::get('page_locale');
        
        $this->guard()->logout();
        $request->session()->invalidate();

        Session::put('locale',$page_locale);
        Session::save();
        
        return back();
    }
}
