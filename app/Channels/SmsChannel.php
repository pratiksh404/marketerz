<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $id = method_exists($notifiable, 'routeNotificationForSms')
            ? $notifiable->routeNotificationForSms($notifiable)
            : $notifiable->getKey();

        $message = method_exists($notification, 'toSms')
            ? $notification->toSms($notifiable)
            : $notification->toArray($notifiable);
        
        // SMS Executuon
        $message->send();
        // SMS Test Execution
        $message->dryRun()->send();
    }
}
