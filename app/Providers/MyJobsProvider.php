<?php

namespace App\Providers;

use App\Models\Admin\Process;
use App\Services\CampaignJSON;
use App\Services\CampaignProcess;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;
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
            /* Store Job Campaign Process */
            (new CampaignProcess($event->job->payload()))->store();
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

            $process = Process::where('uuid', $event->job->uuid())->first();

            if (isset($process)) {
                $process->update([
                    'status' => 2
                ]);
            }
        });
    }
}
