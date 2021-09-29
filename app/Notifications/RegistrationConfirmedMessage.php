<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Config;

class RegistrationConfirmedMessage extends Notification
{
    use Queueable;
    private $user;
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $this->user;
        $name = $user->isPerson()?$user->name:$user->userInfos->orga_name;
        $immat = $user->immat;
        $login = $name;
        $email = $user->email;
        $password = $this->password;
        $content = "";
        $lia = Config::lia();
        $lia_name = $lia->get_meta('lia_name')->value;

        if($user->hasRole(5)){ //Member
            $content = 'mail.registration.confirmed.member';
        }elseif($user->hasRole(2)){ // Seller
            if($user->isSlp()){
                $content = 'mail.registration.confirmed.seller.slp';
            }
            if($user->isSnp()){
                $content = 'mail.registration.confirmed.seller.snp';
            }
            if($user->isSbu()){
                $content = 'mail.registration.confirmed.seller.rep';
            }
            if($user->isSde()){
                $content = 'mail.registration.confirmed.seller.rep';
            }
            if($user->isSbaBusiness()){
                $content = 'mail.registration.confirmed.seller.ba_bu';
            }
            if($user->isSbaIndividual()){
                $content = 'mail.registration.confirmed.seller.ba_ind';
            }
        }elseif($user->hasRole(3)){ // AFA
            $content = 'mail.registration.confirmed.afa';
        }elseif($user->hasRole(4)){ // APL
            $content = 'mail.registration.confirmed.apl';
        }else{
            $content = 'mail.registration.confirmed.member';
        }

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('mail.created.subject', ['app'=>app_name()]))
            ->line(__($content, ['name'=>$name, 'immat'=>$immat, 'login'=>$login, 'email'=>$email, 'password'=>$password, 'ieaagencyname'=>$lia_name]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
