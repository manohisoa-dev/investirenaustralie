<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class MemberWaitingMessage extends Notification
{
    use Queueable;
    
    private $user;
    private $dt;
    private $hr;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->dt = Carbon::now()->format('m-d-Y');
        $this->hr = Carbon::now()->format('H:i:m');
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
        $user= $this->user;
        $userName= $user->isPerson()?$user->name:$user->userinfos->orga_name;
        $dt = $this->dt;
        $hr = $this->hr;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('app.message'))
            ->subject(__('mail.created.subject', ['app'=>app_name()]))
            ->line(__('member.waiting_message', ['user'=>$userName,'date'=>$dt,'hour'=>$hr,'afa'=>$user->afa->name]));
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
