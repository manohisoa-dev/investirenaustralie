<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailTemplate;
use Mail;
use App\Models\MailsTemplate;

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
        $content = ['title' => $template[0]->titre, 'body' => $template[0]->$body];
        /*preg_match_all("!\{(\w+)\}!", $template[0]->$body, $matches);
        foreach($matches[1] as $val){
            echo $val.'<br>';
        }
        $receiverAddress = 'dev4.easydata@gmail.com';*/
        Mail::to($email_send)->send(new MailTemplate($content, $template[0]->$subject));
        return response()->json(['success' => 'true']);
    }
}
