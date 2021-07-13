<?php

namespace App\Http\Livewire\Admin\Lead;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Lead;
use App\Models\Admin\Source;
use Livewire\WithPagination;
use App\Models\Admin\Service;
use Illuminate\Support\Facades\Cache;

class Leads extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filter = 1;
    public $source_id;
    public $service_id;
    public $lead_by;
    public $assigned_to;
    public $startDate;
    public $endDate;

    protected $listeners = ['service_leads' => 'serviceLeads', 'source_leads' => 'sourceLeads', 'leadBy_leads' => 'leadByLeads', 'assignedTo_leads' => 'assignedToLeads', 'date_range_filter' => 'dateRangeFilter', 'lead_status_changed' => '$refresh'];

    public function mount()
    {
        $this->filter = 1;
        $this->resetPage();
    }

    public function serviceLeads($service_id)
    {
        $this->filter = 2;
        $this->resetPage();
        $this->service_id = $service_id;
        $this->emit('lead_status_changed');
    }

    public function sourceLeads($source_id)
    {
        $this->filter = 3;
        $this->resetPage();
        $this->source_id = $source_id;
        $this->emit('lead_status_changed');
    }

    public function leadByLeads($lead_by)
    {
        $this->filter = 4;
        $this->resetPage();
        $this->lead_by = $lead_by;
        $this->emit('lead_status_changed');
    }

    public function assignedToLeads($assigned_to)
    {
        $this->filter = 5;
        $this->resetPage();
        $this->assigned_to = $assigned_to;
        $this->emit('lead_status_changed');
    }

    public function dateRangeFilter($startDate, $endDate)
    {
        $this->filter = 6;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        /* Resets */
        $this->resetPage();
        $this->emit('lead_status_changed');
    }

    public function render()
    {
        $sources = Cache::get('sources', Source::latest()->get());
        $services = Cache::get('services', Service::latest()->get());
        $users = Cache::get('users', User::latest()->get());
        $leads = $this->getLeads();
        return view('livewire.admin.lead.leads', compact('leads', 'sources', 'services', 'users'));
    }

    protected function getLeads()
    {
        $filter = $this->filter;
        if ($filter == 1) {
            return Lead::with('contact', 'source', 'services', 'package', 'leadBy', 'assignedTo')->latest()->paginate(9);
        } elseif ($filter == 2) {
            $service = Service::find($this->service_id);
            return $service->leads()->paginate(9);
        } elseif ($filter == 3) {
            return Lead::with('contact', 'source', 'services', 'package', 'leadBy', 'assignedTo')->where('source_id', $this->source_id)->latest()->paginate(9);
        } elseif ($filter == 4) {
            return Lead::with('contact', 'source', 'services', 'package', 'leadBy', 'assignedTo')->where('lead_by', $this->lead_by)->latest()->paginate(9);
        } elseif ($filter == 5) {
            return Lead::with('contact', 'source', 'services', 'package', 'leadBy', 'assignedTo')->where('assigned_to', $this->assigned_to)->latest()->paginate(9);
        } elseif ($filter == 6) {
            $start = Carbon::create($this->startDate);
            $end = Carbon::create($this->endDate);
            return Lead::whereBetween('updated_at', [$start->toDateString(), $end->toDateString()])->with('contact', 'source', 'service', 'leadBy', 'assignedTo')->latest()->paginate(10);
        } else {
            return Lead::with('contact', 'source', 'services', 'package', 'leadBy', 'assignedTo')->latest()->paginate(9);
        }
    }
}
