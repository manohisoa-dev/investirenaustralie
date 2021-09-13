<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class MemberMandateSearchMessage extends Notification
{
    use Queueable;

    private $user;
    private $product;
    private $dt;
    private $hr;
    private $uploadForm6;
    private $downloadForm6;
    private $abort;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$product,$downloadForm6,$uploadForm6,$abort)
    {
        $this->user = $user;
        $this->product = $product;
        $this->dt = Carbon::now()->format('m-d-Y');
        $this->hr = Carbon::now()->format('H:i:m');
        $this->uploadForm6 = $uploadForm6;
        $this->downloadForm6 = $downloadForm6;
        $this->abort = $abort;
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
        $product = $this->product;
        $dt = $this->dt;
        $hr = $this->hr;
        $uploadForm6 = $this->uploadForm6;
        $downloadForm6 = $this->downloadForm6;
        $abort = $this->abort;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('app.message'))
            ->subject(__('mail.message_from_iea.subject', ['app'=>app_name()]))
            ->line(__('member.mr.message_to_member', ['date'=>$dt,'hour'=>$hr,'name'=>$user->name,'immat'=>$user->immat,'etat'=>$product->location->area_level_1,'afa'=>$user->afa->name,'download_mr'=>$downloadForm6,'upload_mr'=>$uploadForm6,'abort'=>$abort]));
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
