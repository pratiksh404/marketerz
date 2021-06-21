<?php

namespace App\Http\Livewire\Admin\Job;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FailedJob extends Component
{
    public $total_jobs = 0;
    public $total_failed_jobs = 0;
    public $total_success_jobs = 0;
    public $success_percent = 0;

    protected $listeners = [
        'retry_all_failed_jobs' => 'retryAllFailedJobs',
        'delete_all_failed_jobs' => 'deleteAllFailedJobs',
        'retry_job' => 'retryJob',
        'delete_job' => 'deleteJob'
    ];

    public function mount()
    {
        $this->initializeJobs();
    }

    public function retryAllFailedJobs()
    {
        Artisan::call('queue:retry all');
        $this->initializeJobs();
    }

    public function deleteAllFailedJobs()
    {
        Artisan::call('queue:flush');
        $this->initializeJobs();
    }

    public function retryJob($uuid)
    {
        Artisan::call("queue:retry", ['id' => [$uuid]]);
        $this->initializeJobs();
    }

    public function deleteJob($uuid)
    {
        Artisan::call("queue:forget", ['id' => [$uuid]]);
        $this->initializeJobs();
    }

    public function render()
    {
        $failed_jobs = DB::table('failed_jobs')->get();
        return view('livewire.admin.job.failed-job', compact('failed_jobs'));
    }

    private function initializeJobs()
    {
        $this->total_jobs = DB::table('failed_jobs')->count();
        $this->total_failed_jobs = DB::table('failed_jobs')->count();
        $this->total_success_jobs = $this->total_jobs - $this->total_failed_jobs;
        $this->success_percent = $this->total_jobs == 0 ? 100 : (($this->total_success_jobs / $this->total_jobs) * 100);
    }
}
