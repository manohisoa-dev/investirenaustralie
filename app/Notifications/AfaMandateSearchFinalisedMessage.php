<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use App\Models\Country;

class AfaMandateSearchFinalisedMessage extends Notification
{
    use Queueable;
    private $user;
    private $dt;
    private $hr;
    private $country;
    private $linkcompletetrans;
    private $mandatesearch;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$linkcompletetrans,$mandatesearch)
    {
        $this->user = $user;
        $this->dt = Carbon::now()->format('m-d-Y');
        $this->hr = Carbon::now()->format('H:i:m');
        $this->country = $country = Country::where('code',$this->user->location->country)->pluck('content')[0];;
        $this->linkcompletetrans = $linkcompletetrans;
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
        $city = $user->afa->location->locality;
        $country = $this->country;
        $mandatesearch = $this->mandatesearch;
        $linkcompletetrans = $this->linkcompletetrans;
        $userName = $user->isPerson()?$user->name:$user->userinfos()->first()->orga_name;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('app.message'))
            ->subject(__('mail.message_from_iea.subject', ['app'=>app_name()]))
            ->line(__('member.tobuy.mr.message_to_afa', ['date'=>$dt,'hour'=>$hr,'name'=>$userName,'country'=>$country,'city'=>$city,'afa' =>$user->afa->name,'linkcompletetrans'=>$linkcompletetrans,'mandatesearch'=>$mandatesearch]));
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
