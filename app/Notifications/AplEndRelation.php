<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class AplEndRelation extends Notification
{
    use Queueable;

    private $nbDays;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nbDays=0,User $user)
    {
        $this->nbDays = $nbDays;
        $this->user = $user;
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
        return (new MailMessage)
                    ->line(__('mail.txt.end_exclusive_relationship_with_member', ['user'=>$this->user->name, 'immat'=>$this->user->immat, 'day'=>$this->nbDays]))
                    ->action(__('mail.btn.login'), url('/login'))
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
