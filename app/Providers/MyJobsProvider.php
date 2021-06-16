<?php

namespace App\Providers;

use App\Services\CampaignJSON;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;

class MyJobsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Log jobs
         *
         * Job dispatched & processing
         */
        Queue::before(function (JobProcessing $event) {
            Log::channel('campaign')->info('Job ready: ' . $event->job->resolveName());
            Log::channel('campaign')->info('Job startet: ' . $event->job->resolveName());
            Log::channel('campaign')->info(json_encode($event->job->payload()));
        });

        /**
         * Log jobs
         *
         * Job processed
         */
        Queue::after(function (JobProcessed $event) {
            Log::notice('Job done: ' . $event->job->resolveName());
            (new CampaignJSON($event->job, true))->storeToJSONCampaign();
        });

        /**
         * Log jobs
         *
         * Job failed
         */
        Queue::failing(function (JobFailed $event) {
            Log::error('Job failed: ' . $event->job->resolveName() . '(' . $event->exception->getMessage() . ')');
        });
    }
}
