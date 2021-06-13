<?php

namespace App\Listeners;

use App\Events\CampaignCreatedEvent;
use App\Jobs\EmailNotification;
use App\Jobs\SMSNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExecuteCampaignListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CampaignCreatedEvent $event)
    {
        $campaign = $event->camapign ?? null;
        if ($campaign) {
            $contacts = Contact::where('active', 1)->find($campaign->contacts);
            if (isset($contacts)) {
                foreach ($contacts as $contact) {
                    // Email Notification Job
                    EmailNotification::dispatchIf($campaign->getRawOriginal('channel') == 1, $campaign, $contact);
                    // SMS Notification Job
                    SMSNotification::dispatchIf($campaign->getRawOriginal('channel') == 2, $campaign, $contact);
                }
            }
        }
    }
}
