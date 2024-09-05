<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        $response = [
            'message' => 'Notification marked as read'
        ];
        return response($response, 201);
    }
}
