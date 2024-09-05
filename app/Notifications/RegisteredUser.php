<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredUser extends Notification
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
    ) {}

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
    public function toMaill($notifiable)
    {
        // $url = "https://fidelity.bbdesign.dev/historic";
        $url = "http://127.0.0.1:3000/historic";
        return (new MailMessage)
                    ->greeting('Hello '.$this->user->name.' !')
                    ->line('You are now registered with the loyalty program and can benefit from all the advantages usered by this program.')
                    ->line('You are now able to make a payment by points.')
                    ->action('See Your historic', $url)
                    //->lineIf($this->amount > 0, "Amount paid: {$this->amount}")
                    ->line('Thank you for continuing to trust Brain-Booster!');
    }

    public function toMail($notifiable)
    {
        // $url = "https://fidelity.bbdesign.dev/historic";
        $url = "http://127.0.0.1:3000/historic";
        return (new MailMessage)
                    ->greeting('Hello '.$this->user->name.' !')
                    ->line('By subscribing to the service '.$this->service->name.', You have just joined our BB-Fidelity loyalty program.')
                    ->line('You can benefit from all the advantages usered by this program. You are now able to make a payment by points.s')
                    ->line('Your balance is now: '.$this->user->balance)
                    ->action('See your historic', $url)
                    //->lineIf($this->amount > 0, "Amount paid: {$this->amount}")
                    ->line('Thank you for continuing to trust Brain-Booster!');
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
            'user_id' => $this->user->id,
            'service_id' => $this->service->id,
            'balance' => $this->user->balance,
        ];
    }
}
