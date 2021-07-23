<?php

namespace App\Http\Livewire\Admin\Statistics;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Admin\Lead;
use App\Models\Admin\Client;
use App\Models\Admin\Advance;
use App\Models\Admin\Payment;
use App\Models\Admin\Project;

class TotalCount extends Component
{
    public $filter = 1;
    public $payments;
    public $advances;
    public $projects;
    public $clients;
    public $leads;


    public function totalCount()
    {
        $this->filter = 1;
        $this->emit('total_count_filter_applied');
    }

    public function todayCount()
    {
        $this->filter = 2;
        $this->emit('total_count_filter_applied');
    }

    public function weekCount()
    {
        $this->filter = 3;
        $this->emit('total_count_filter_applied');
    }

    public function monthCount()
    {
        $this->filter = 4;
        $this->emit('total_count_filter_applied');
    }

    public function yearCount()
    {
        $this->filter = 5;
        $this->emit('total_count_filter_applied');
    }

    public function mount()
    {
        $this->filter = 1;
        $this->payments = Payment::all();
        $this->advances = Advance::all();
        $this->projects  = Project::all();
        $this->clients = Client::all();
        $this->leads = Lead::all();
    }

    public function render()
    {
        $this->assignCollections();
        return view('livewire.admin.statistics.total-count');
    }

    protected function assignCollections()
    {
        $filter = $this->filter;
        if ($filter == 1) {
            $this->payments = Payment::all();
            $this->advances = Advance::all();
            $this->projects  = Project::all();
            $this->clients = Client::all();
            $this->leads = Lead::all();
        } elseif ($filter == 2) {
            $this->payments = Payment::whereDate('updated_at', Carbon::now())->get();
            $this->advances = Advance::whereDate('updated_at', Carbon::now())->get();
            $this->projects  = Project::whereDate('updated_at', Carbon::now())->get();
            $this->clients = Client::whereDate('updated_at', Carbon::now())->get();
            $this->leads = Lead::whereDate('updated_at', Carbon::now())->get();
        } elseif ($filter == 3) {
            $this->payments = Payment::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $this->advances = Advance::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $this->projects  = Project::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $this->clients = Client::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $this->leads = Lead::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } elseif ($filter == 4) {
            $this->payments = Payment::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
            $this->advances = Advance::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
            $this->projects  = Project::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
            $this->clients = Client::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
            $this->leads = Lead::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        } elseif ($filter == 5) {
            $this->payments = Payment::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
            $this->advances = Advance::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
            $this->projects  = Project::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
            $this->clients = Client::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
            $this->leads = Lead::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        }
    }
}
