<?php

namespace App\Traits;

use App\Traits\HasSlack;

trait HasTaskNotification
{
    /**
     * Route notifications for the Sparrow channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSparrow($notifiable)
    {
        return $this->id;
    }
}
