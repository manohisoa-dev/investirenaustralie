<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailTemplate;
use Mail;
use App\Models\MailsTemplate;
use App\Models\ParametersEmail;
use Auth;

class SendMailController extends Controller {
    /**
     * Show the application sendMail.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendMail() {
        $id_template = $_POST['id_template'];
        $email_send = $_POST['send_to'];
        $lang = $_POST['langue'];

        $body = 'template_' . $lang;
        $subject = 'sujet_' . $lang;
        $template = MailsTemplate::where('id', $id_template)->get();
        $tpl = $template[0]->$body;
        
        preg_match_all("/\[(.*?)\]/", $tpl, $matches);
        foreach($matches[1] as $token){
            $token_txt = '['.$token.']';
            $model_token = ParametersEmail::where('nom_variable', $token_txt)->get();
            if($model_token[0]->model_name != ''){
                $token_value = $model_token[0]->model_name;
            }else{
                $token_value = '';
            }
            
            $tpl = str_replace($token_txt,$token_value,$tpl);
        }
        $content = ['body' => $tpl];
        //$content = ['title' => $template[0]->titre, 'body' => $template[0]->$body];
        /*preg_match_all("!\{(\w+)\}!", $template[0]->$body, $matches);
        foreach($matches[1] as $val){
        echo $val.'<br>';
        }
        $receiverAddress = 'dev4.easydata@gmail.com';*/
        Mail::to($email_send)->send(new MailTemplate($content, $template[0]->$subject));
        return response()->json(['success' => 'true']);
    }
}
