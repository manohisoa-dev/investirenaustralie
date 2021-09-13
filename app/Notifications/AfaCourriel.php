<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\User;

class AfaCourriel extends Notification
{
    use Queueable;

    private $user;
    private $afa;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $afa)
    {
        $this->user = $user;
        $this->afa = $afa;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Send document for member
        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->cc('iea.dev.v2@gmail.com')
            ->subject(__('mail.message_from_iea.subject', ['app'=>app_name()]))
            ->greeting(__('mail.greeting', ['name'=>$this->user->name]))
            ->subject(__('mail.document.sent'))
            ->line(__("mail.document.sent"))
            ->attach(public_path('pdf/engagement.pdf'), [
                'as' => 'engagement.pdf',
                'mime' => 'application/pdf'])
            ->attach(public_path('pdf/form6_en.pdf'), [
                'as' => 'form6_en.pdf',
                'mime' => 'application/pdf'])
            ->attach(public_path('pdf/form6_fr.pdf'), [
                'as' => 'form6_fr.pdf',
                'mime' => 'application/pdf'])
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
        if(!$this->afa){
            // Notify USER
            return [
                'id' => $this->id,
                'read_at' => null,
                'data' => [
                    'is_apl' => $this->afa,
                    'user_id' => $this->user->afa->id,
                    'user_name' => $this->user->afa->name,
                    'message' => 'Vous avez changé votre AFA.',
                ],
            ];
        }
        
        // Notify AFA
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'is_afa' => $this->afa,
                'user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'message' => $this->user->name . ' vous a selectionné comme AFA.',
            ],
        ];
    }
}
