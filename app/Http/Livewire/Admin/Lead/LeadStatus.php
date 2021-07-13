<?php

namespace App\Http\Livewire\Admin\Lead;

use Livewire\Component;
use App\Models\Admin\Lead;

class LeadStatus extends Component
{
    public $lead;

    protected $listeners = ['status_changed' => 'statusChanged'];


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
