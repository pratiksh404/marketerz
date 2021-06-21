<?php

namespace App\Http\Livewire\Admin\Job;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\Process;

class Processes extends Component
{
    use WithPagination;

    public $filter = 1;
    public $campaign;
    public $comtact;

    public function mount($campaign = null, $comtact = null)
    {
        $this->campaign = $campaign;
        $this->comtact = $comtact;
    }

    public function all_processes()
    {
        $this->filter = 1;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_processes');
    }

    public function email_process()
    {
        $this->filter = 2;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_processes');
    }

    public function sms_process()
    {
        $this->filter = 3;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_processes');
    }

    public function processing_process()
    {
        $this->filter = 4;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_processes');
    }

    public function success_process()
    {
        $this->filter = 5;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_processes');
    }

    public function failed_process()
    {
        $this->filter = 6;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_processes');
    }

    public function retry_process()
    {
        $this->filter = 7;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_processes');
    }

    public function render()
    {
        $processes = $this->getProcesses();
        return view('livewire.admin.job.processes', compact('processes'));
    }

    private function getProcesses()
    {
        $processes = Process::with('campaign', 'contact')->latest();
        $filter = $this->filter;
        if ($filter == 1) {
            $processes = $processes;
        } elseif ($filter == 2) {
            $processes = Process::where('channel', 1);
        } elseif ($filter == 3) {
            $processes = Process::where('channel', 2);
        } elseif ($filter == 4) {
            $processes = Process::where('status', 0);
        } elseif ($filter == 5) {
            $processes = Process::where('status', 1);
        } elseif ($filter == 6) {
            $processes = Process::where('status', 2);
        } elseif ($filter == 7) {
            $processes = Process::where('status', 3);
        } else {
            $processes = $processes;
        }
        if (isset($this->campaign)) {
            return $processes->where('campaign_id', $this->campaign)->paginate(10);
        } elseif (isset($this->campaign)) {
            return $processes->where('contact_id', $this->contact_id)->paginate(10);
        } else {
            return $processes->paginate(10);
        }
    }
}
