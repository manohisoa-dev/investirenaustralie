<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use App\Models\User;

class AfaConjunctionAgreementMessage extends Notification
{
    use Queueable;

    private $user;
    private $dt;
    private $hr;
    private $uploadCa;
    private $downloadCa;
        
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,$downloadCa,$uploadCa)
    {
        $this->user = $user;
        $this->dt = Carbon::now()->format('m-d-Y');
        $this->hr = Carbon::now()->format('H:i:m');
        $this->uploadCa = $uploadCa;
        $this->downloadCa = $downloadCa;
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
        $downloadCa = $this->downloadCa;
        $uploadCa = $this->uploadCa;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('app.message'))
            ->subject(__('mail.created.subject', ['app'=>app_name()]))
            ->line(__('member.gothere.select_afa.ca.message_to_afa', ['date'=>$dt,'hour'=>$hr,'name'=>$user->name,'immat'=>$user->immat,'agence' => 'IEA', 'download_ca'=>$downloadCa, 'upload_ca'=>$uploadCa]));
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
