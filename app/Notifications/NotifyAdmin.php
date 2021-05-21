<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyAdmin extends Notification
{
    use Queueable;
    
    private $user;
    private $userLogged;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$userLogged,$message)
    {
        $this->user = $user;
        $this->userLogged = $userLogged;
        $this->message = $message;
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
        $message = $this->message;
        $userLogged = $this->userLogged;
        
        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('mail.activated.subject', ['app'=>app_name()]))
            ->greeting(__('mail.greeting', ['name'=>$user->name]))
            ->line(__($message))
            ->line('<br>')
            ->line(__('mail.suspended.user', ['user'=>$userLogged->name]))
            ->line(__('<br>'));
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
