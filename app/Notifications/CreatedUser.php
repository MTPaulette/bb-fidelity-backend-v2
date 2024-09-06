<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private User $user,
        private string $password,
        private User $receiver,
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
        $login_url = env('APP_FRONTEND_URL').'/login';
        $user_profile = env('APP_FRONTEND_URL')."/user/{$this->user->id}";
    
        if($this->receiver->role_id != 2) {
            return (new MailMessage)
                        ->greeting("Hello {$this->receiver->name} !")
                        ->line("The Bb-fidelity account of the user {$this->user->name} has been successfully created")
                        ->action("See his profile", $user_profile)
                        ->line("Thank you for continuing to trust Brain-Booster!");
        } else {
            return (new MailMessage)
                        ->greeting("Hello {$this->receiver->name} !")
                        ->line("Your Bb-fidelity account has been successfully created")
                        ->line("You accesses are:")
                        ->line("Email: {$this->user->email} , Password: {$this->password}")
                        ->line("We strongly recommend that you log in to your profile and change your password.")
                        ->action("See your profile", $login_url)
                        ->line("Thank you for continuing to trust Brain-Booster!");
        }
    }
}
