<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseFailed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private User $user,
        private Service $service,
        private User $receiver,
        private string $reason,
    ) {}

    /**
     * Get the notification"s delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ["mail"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $historic_url = env('APP_FRONTEND_URL').'/historic';
        $user_historic_url = env('APP_FRONTEND_URL')."/user/{$this->user->id}/history";
    
        if($this->receiver->role_id != 2) {
            return (new MailMessage)
                        ->greeting("Hello {$this->receiver->name} !")
                        ->line("{$this->service->name} service subscription for used {$this->user->name} failed!")
                        ->line("Reason: {$this->reason}")
                        ->action("See the user's historic", $user_historic_url)
                        ->line("Thank you for continuing to trust Brain-Booster!");
        } else {
            return (new MailMessage)
                        ->greeting("Hello {$this->receiver->name} !")
                        ->line("{$this->service->name} service subscription failed!")
                        ->line("Reason: {$this->reason}")
                        ->action("See your historic", $historic_url)
                        ->line("Thank you for continuing to trust Brain-Booster!");
        }
    }
}
