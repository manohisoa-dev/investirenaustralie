<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Notifications\RegistrationConfirmedMessage;
use App\Notifications\RegistrationRejectedMessage;
use App\Models\Contract;
use App\Models\User;
use App\Models\MailsTemplate;
use App\Models\TemplateModel;
use App\Models\Parameter;
use App\Models\Config;
use App\Mail\MailTemplate;
use Jleon\LaravelPnotify\Notify;
use Carbon\Carbon;
use App;
use DB;

class ContractController extends Controller
{
    public $viewDir = "admin.contract";

    public function index()
    {
        $records = Contract::findRequested();
        return $this->view( "index", ['records' => $records] );
    }

    // Method to set in admin controller
    public function validateContract($id){
        // Update contract to validate
        $contract = Contract::whereId($id)->first();
        $contract->update(['status_contract'=>2]);

        // Send notification to user
        $user = User::whereId($contract->user_id)->first();
        $password = str_random(10);
        
        // Active user compte
        $user->update(['status'=>'active', 'activation_code'=>null, 'trial_ends_at'=>Carbon::now()->addDays(option('payment.trial_delay', 14)), 'password'=>Hash::make($password)]);
        
        $lia = Config::lia();
        $lia_name = $lia->get_meta('lia_name')->value;
        App::setLocale($user->language);
        $lang = $user->language;
        $body = 'template_' . $lang;
        $vars = array(
            '{immat}' => $user->immat,
            '{login}' => $user->name,
            '{email}' => $user->email,
            '{password}' => $password,
            '{ieaagencyname}' => $lia_name,
        );
        $template = MailsTemplate::where('id', $user->roleUser->role_initial=='afa'?11:17)->first();
        if($template){
            $sujet = $lang=='fr'?$template->sujet_fr:$template->sujet_en;
            $content = strtr($template->$body, $vars);
            $content = ['title' => '', 'body' => $content];
        }else{
            return abort(404);
        }

        $user->notify(new RegistrationConfirmedMessage($sujet,$content));

        Notify::success('Contract accepted');
        return back();
    }
    
    public function rejectContract($id){
        $contract = Contract::whereId($id)->first();
        $user = User::whereId($contract->user_id)->first();
        $nbContract = Contract::where('user_id',$contract->user_id)->count();

        // get template
        App::setLocale($user->language);
        $lang = $user->language;
        $body = 'template_' . $lang;
        $vars = array(
            '{role}' => strtoupper($user->roleUser->role_initial),
        );
        $template = MailsTemplate::where('id', $nbContract!==2?18:19)->first();

        if($template){
            $sujet = $lang=='fr'?$template->sujet_fr:$template->sujet_en;
            $content = strtr($template->$body, $vars);
            $content = ['title' => '', 'body' => $content];
        }else{
            return abort(404);
        }

        // Notify user
        $user->notify(new RegistrationRejectedMessage($sujet,$content));

        if($nbContract===2){
            DB::table('users')->where('id', $user->id)->delete();
            DB::table('contracts')->where('user_id', $user->id)->delete();
        }else{
            $contract->update(['status_contract'=>3,'date_fin_reponse_contract'=>Carbon::now()->addDays(Parameter::nbDayEndResponseContract())]);
        }
        
        Notify::success('Contract rejected');
        return back();
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }
}
