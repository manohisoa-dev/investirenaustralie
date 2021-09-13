<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class AfaMandateSearchMessage extends Notification
{
    use Queueable;
    private $user;
    private $dt;
    private $hr;
    private $mandatesearch;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$mandatesearch)
    {
        $this->user = $user;
        $this->dt = Carbon::now()->format('m-d-Y');
        $this->hr = Carbon::now()->format('H:i:m');
        $this->mandatesearch = $mandatesearch;
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
        $dt = $this->dt;
        $hr = $this->hr;
        $mandatesearch = $this->mandatesearch;
        $city = $user->afa->location->locality;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('app.message'))
            ->subject(__('mail.message_from_iea.subject', ['app'=>app_name()]))
            ->line(__('member.gothere.mr.message_to_afa', ['date'=>$dt,'hour'=>$hr,'name'=>$user->name,'immat'=>$user->immat,'city'=>$city,'afa' =>$user->afa->name,'mandatesearch'=>$mandatesearch]));
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
