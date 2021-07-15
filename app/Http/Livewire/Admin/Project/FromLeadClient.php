<?php

namespace App\Http\Livewire\Admin\Project;

use Livewire\Component;
use App\Models\Admin\Lead;
use App\Models\Admin\Client;
use App\Models\Admin\Package;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Cache;

class FromLeadClient extends Component
{
    public $project;
    public $projectfrom = null;
    public $leadid;
    public $clientid;
    public $lead;
    public $client;
    public $packageid;
    public $package;

    public function mount($project, $projectfrom)
    {
        $this->project = $project;
        $this->projectfrom = $projectfrom;
        $this->leadid = $project->lead_id ?? null;
        $this->clientid = $project->client_id ?? null;
        $this->lead = $project->lead ?? null;
        $this->client = $project->client ?? null;
        $this->package = $project->package ?? null;
        $this->packageid = $project->package_id ?? null;
    }


    public function updatedLeadid()
    {
        if ($this->leadid) {
            $this->lead = Lead::find($this->leadid);
            $this->package = $this->lead->package ?? null;
            $this->packageid = $this->lead->package_id ?? null;
        }
        $this->dispatchBrowserEvent('from_lead_event', ['lead_id' => $this->leadid]);
    }

    public function updatedClientid()
    {
        if ($this->clientid) {
            $this->client = Client::find($this->clientid);
        }
        $this->dispatchBrowserEvent('from_client_event', ['client_id' => $this->clientid]);
    }

    public function updatedPackageid()
    {
        $this->package = Package::find($this->packageid);
    }

    public function render()
    {
        $leads = Cache::get('leads', Lead::with('contact', 'package')->latest()->get());
        $clients = Cache::get('clients', Client::latest()->get());
        $packages = Cache::get('packages', Package::latest()->get());
        return view('livewire.admin.project.from-lead-client', compact('leads', 'clients', 'packages'));
    }
}
