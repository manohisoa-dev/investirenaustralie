<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use Validator;

use App\Models\User;
use App\Models\Config;

use App\Notifications\NewMail;
use App\Http\Controllers\Controller;
use Jleon\LaravelPnotify\Notify;

class ConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role', ['only' => [
            '1',
            '6',
        ]]);
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function site(Request $request)
    {
        $item = Config::site();
        $keys = Config::siteRules();

        if ($request->isMethod('post')) {

            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, $keys);

            // Check validation
            if ($validator->fails()) {
                #notification
                Notify::error($validator);
                return back()->withErrors($validator)->withInput() ;
            }

            // Save Config into MetaData By Validator rules key
            foreach($keys as $key=>$val){
                if($key == 'admin_email'){
                    if($request->input('admin_email') === null){
                        $item->update_meta('admin_email', "");
                    }else{
                        if($value = $request->input($key)) $item->update_meta('admin_email', $value);    
                    }
                }elseif($key == 'admin_phone'){
                    if($request->input('admin_phone') === null){
                        $item->update_meta('admin_phone', "");
                    }else{
                        if($value = $request->input($key)) $item->update_meta('admin_phone', $value);    
                    }
                }elseif($key == 'admin_fax'){
                    if($request->input('admin_fax') === null){
                        $item->update_meta('admin_fax', "");
                    }else{
                        if($value = $request->input($key)) $item->update_meta('admin_fax', $value);    
                    }
                }else{
                    if($value = $request->input($key)) $item->update_meta($key, $value);
                }

            }

            # notification
            Notify::success('La configuration a été modifiée avec succés ! ');
            return back() ;
        }

        return view('admin.config.site',compact('item', 'keys'))
            ->with('admins', User::isActive()->ofRole('admin')->get())
            ->with('breadcrumbs', __('app.config'));
    }

    /**
     * Show login config
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $item = Config::login();
        $rules = Config::loginRules();
        $keys = Config::loginKeys();

        if ($request->isMethod('post')) {
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, $rules);

            // Check validation
            if ($validator->fails()) {
                Notify::error($validator);
                return back()->withInput();
            }

            // Save Config into MetaData By Validator rules key
            foreach($keys as $key){
                if($value = $request->input($key)){
                    $item->update_meta_array($key, $value);
                }
            }

            // Go back with notification
            Notify::success('La configuration a été modifiée avec succés ! ');
            return back();
        }

        return view('admin.config.login',compact('item'))
            ->with('breadcrumbs', __('app.config'));
    }

    /**
     * Show social config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function social(Request $request)
    {
        $item = Config::social();
        $keys = Config::socialRules();
        $titles = Config::socialTitles();

        if ($request->isMethod('post')) {
            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, $keys);

            // Check validation
            if ($validator->fails()) {
                Notify::error($validator);
                return back()->withInput();
            }

            // Save Config into MetaData By Validator rules key
            foreach($keys as $key=>$val){
                if($value = $request->input($key)) $item->update_meta($key, $value);
            }

            // Go back with notification
            Notify::success('La configuration a été modifiée avec succés ! ');
            return back();
        }

        return view('admin.config.social',compact('item', 'keys', 'titles'))
            ->with('breadcrumbs', __('app.config'));
    }

    /**
     * Show payment config page.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $item = Config::payment();
        $keys = Config::paymentRules();

        if ($request->isMethod('post')) {

            // Validate request
            $datas = $request->all();
            $validator = Validator::make($datas, $keys);

            // Check validation
            if ($validator->fails()) {
                Notify::error($validator);
                return back()->withInput();
            }

            // Save Config into MetaData By Validator rules key
            foreach($keys as $key=>$val){
                $value = $request->input($key)?$request->input($key):0;
                $item->update_meta($key, $value);
            }

            // Go back with notification
            Notify::success('La configuration a été modifiée avec succés ! ');
            return back();
        }

        return view('admin.config.payment',compact('item', 'keys'))
            ->with('breadcrumbs', __('app.config'));
    }


    /**
     * Search FontAwesome
     * @param string $d , string $q, string $m
     * @return Redirection
     */
    public function fontawesome(Request $request)
    {
        $query = $request->input('query');

        if( !empty($query))
            $link = "https://fontawesome.com/icons?d=gallery&q=".rawurlencode($query)."&m=free";
        else
            $link = "https://fontawesome.com/icons?d=gallery&m=free";

        return redirect()->away($link);
    }

}
