<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeletedUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private string $deleted_user_name,
        private User $receiver,
        private string $user_name,
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
        $services_url = env('APP_FRONTEND_URL')."/users";

        return (new MailMessage)
                    ->greeting("Hello {$this->receiver->name} !")
                    ->line("The user {$this->deleted_user_name} has just been deleted by {$this->user_name}.")
                    ->action("View all services", $services_url)
                    ->line("Thank you for continuing to trust Brain-Booster!");
    }
}
