<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SollicitorMessage extends Notification
{
    use Queueable;
    private $sujet;
    private $content;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sujet,$content)
    {
        $this->sujet = $sujet;
        $this->content = $content;
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
        $sujet = $this->sujet;
        $content = $this->content;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('app.message'))
            ->subject('['.app_name().'] '. $sujet)
            ->line($content);
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
