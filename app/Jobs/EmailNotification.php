<?php

namespace App\Jobs;

use Exception;
use App\Mail\CampaignEmail;
use App\Models\Admin\Contact;
use App\Models\Admin\Process;
use Illuminate\Bus\Queueable;
use App\Models\Admin\Campaign;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class EmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $campaign;
    public $contact;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Campaign $campaign, Contact $contact)
    {
        $this->campaign = $campaign;
        $this->contact = $contact;
    }

    /**
     * The unique ID of the job.
     *
     * @return string
     */
    public function uniqueId()
    {
        return $this->contact->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (isset($this->contact) && isset($this->campaign)) {
            $process = Process::where('uuid', $this->job->uuid())->first();
            if (isset($process)) {
                $process->update([
                    'campaign_id' => $this->campaign->id,
                    'contact_id' => $this->contact->id,
                    'status' => 1
                ]);
            }
            Mail::to($this->contact->email)->send(new CampaignEmail($this->campaign));
        }
    }

    public function failed(Exception $exception)
    {
        \Log::channel('failed_email_jobs')->info($exception->getMessage());
    }
}
