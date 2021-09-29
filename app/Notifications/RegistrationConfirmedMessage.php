<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

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

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('mail.created.subject', ['app'=>app_name()]))
            ->line(__('mail.registration.confirmed.member', ['name'=>$name, 'immat'=>$immat, 'login'=>$login, 'email'=>$email, 'password'=>$password]));
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
