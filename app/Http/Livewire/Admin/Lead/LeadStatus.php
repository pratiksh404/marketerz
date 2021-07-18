<?php

namespace App\Http\Livewire\Admin\Lead;

use Livewire\Component;
use App\Models\Admin\Lead;

class LeadStatus extends Component
{
    public $lead;
    public $converted_to_client;

    protected $listeners = ['status_changed' => 'statusChanged'];

    public function mount($lead, $converted_to_client = false)
    {
        $this->lead = $lead;
        $this->converted_to_client = $converted_to_client;
    }


    public function statusChanged($status, Lead $lead)
    {
        $lead->update([
            'status' => $status
        ]);

        $this->lead = $lead;

        $this->emit('lead_status_changed');
    }

    public function render()
    {
        return view('livewire.admin.lead.lead-status');
    }
}
