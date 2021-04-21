<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\User;

class AfaChanged extends Notification
{
    use Queueable;

    private $user;
    private $isAfa;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $isAfa = false)
    {
        $this->user = $user;
        $this->isAfa = $isAfa;
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
        if(!$this->isAfa){
            // Notify USER
            return (new MailMessage)
                    ->from(env('ADMIN_MAIL'))
                    ->subject('AFA Changed')
                    ->greeting(sprintf('Hello %s', $user->name))
                    ->line('You have changed your AFA.')
                    ->action('View More', route('home'))
                    ->line('Thank you for using our application!');
        }
        // Notify AFA
        return (new MailMessage)
                ->from(env('ADMIN_MAIL'))
                ->subject('Selected as AFA')
                ->greeting(sprintf('Hello %s', $user->name))
                ->line('Someone have selected your account as AFA.')
                ->action('View More', route('home'))
                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if(!$this->isAfa){
            // Notify USER
            return [
                'id' => $this->id,
                'read_at' => null,
                'data' => [
                    'is_apl' => $this->isAfa,
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
                'is_afa' => $this->isAfa,
                'user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'message' => $this->user->name . ' vous a selectionné comme AFA.',
            ],
        ];
    }
}
