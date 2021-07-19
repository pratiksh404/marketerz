<?php

namespace App\Providers;

use App\Events\AdvanceEvent;
use App\Events\CampaignCreatedEvent;
use App\Events\PaymentEvent;
use App\Events\ProjectInitializedEvent;
use App\Events\ReturnEvent;
use App\Listeners\AdvanceTransactionListener;
use App\Listeners\ExecuteCampaignListener;
use App\Listeners\PaymentTransactionListener;
use App\Listeners\ProjectInitializedListener;
use App\Listeners\ReturnTransactionListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CampaignCreatedEvent::class => [
            ExecuteCampaignListener::class,
        ],
        ProjectInitializedEvent::class => [
            ProjectInitializedListener::class,
        ],
        PaymentEvent::class => [
            PaymentTransactionListener::class,
        ],
        ReturnEvent::class => [
            ReturnTransactionListener::class,
        ],
        AdvanceEvent::class => [
            AdvanceTransactionListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
