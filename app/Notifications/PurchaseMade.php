<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseMade extends Notification
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
        private bool $by_cash,
        private float $new_balance,
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
                        ->line("The user {$this->user->name} has just subscribed to {$this->service->name} service at our {$this->service->agency} agency.")
                        ->line("This service is valid for {$this->service->validity}.")
                        ->lineIf($this->by_cash, "By a payment in cash, this service cost him {$this->service->price} Francs CFA. His balance has been credited with {$this->service->credit} point(s).")
                        ->lineIf(!$this->by_cash, "By a payment by point, he has been debited with {$this->service->debit} point(s).")
                        ->line("The user balance is now worth {$this->new_balance} point(s).")
                        ->action("See the user's historic", $user_historic_url)
                        ->line("Thank you for continuing to trust Brain-Booster!");
        } else {
            return (new MailMessage)
                        ->greeting("Hello {$this->receiver->name} !")
                        ->line("You have just subscribed to {$this->service->name} service at our {$this->service->agency} agency.")
                        ->line("This service is valid for {$this->service->validity}.")
                        ->lineIf($this->by_cash, "By a payment in cash, this service cost you {$this->service->price} Francs CFA. Your balance has been credited with {$this->service->credit} point(s).")
                        ->lineIf(!$this->by_cash, "By a payment by point, you have been debited with {$this->service->debit} point(s).")
                        ->line("Your balance is now worth {$this->new_balance} point(s).")
                        ->action("See your historic", $historic_url)
                        ->line("Thank you for continuing to trust Brain-Booster!");
        }
    }
}
