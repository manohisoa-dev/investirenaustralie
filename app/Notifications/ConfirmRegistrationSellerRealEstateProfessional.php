<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmRegistrationSellerRealEstateProfessional extends Notification
{
    use Queueable;
    private $user;
    private $confirmLink;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$confirmLink)
    {
        $this->user = $user;
        $this->confirmLink = $confirmLink;
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
        $confirmLink = $this->confirmLink;
        
        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('mail.created.subject', ['app'=>app_name()]))
            ->line(__('mail.confirm.registration.message.seller.rep.1'))
            ->action(strtoupper(__('mail.btn.confirm.registration')), $confirmLink)
            ->line(__('mail.confirm.registration.message.seller.rep.2'));
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
