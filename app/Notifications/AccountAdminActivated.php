<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountAdminActivated extends Notification
{
    use Queueable;
    
    private $user;
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user , $password)
    {
        $this->user = $user;
        $this->status = $password;
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
        /** @var User $user */
        $user = $this->user;
        $password = $this->password;
        
        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('mail.activated.subject', ['app'=>app_name()]))
            ->greeting(__('mail.greeting', ['name'=>$user->name]))
            ->line(__('mail.activated.collaborator.account.content'))
            ->line(__('mail.activated.login.info',  ['login'=>$user->email, 'password'=>$password]))
            ->action(__('mail.btn.login'), route('login'))
            ->line(__('mail.thank'));
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
