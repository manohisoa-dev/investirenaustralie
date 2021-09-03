<?php

namespace App\Models;
use App;
use Mail;
use App\Models\MailsTemplate;
use App\Mail\MailTemplate;

class TemplateModel {
    function sendMailNotification($templateId, $variables,$email_to) {
        $template_table = MailsTemplate::set_content_email($templateId);
        $lang = App::getLocale();
        $body_label = 'template_' . $lang;
        $sujet_label = 'sujet_'.$lang;
        $sujet = $template_table[0]->$sujet_label;
        
        $subjet = strtr($sujet,$variables);
        $body = $template_table[0]->$body_label;
        $template = strtr($body, $variables);
        
        $content = ['title' => '', 'body' => $template];
        Mail::to($email_to)->send(new MailTemplate($content, $subjet));
    }
}
