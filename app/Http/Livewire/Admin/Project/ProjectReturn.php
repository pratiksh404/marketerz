<?php

namespace App\Http\Livewire\Admin\Project;

use Livewire\Component;
use App\Models\Admin\Project;

class ProjectReturn extends Component
{
    public $project;
    public $price;
    public $grand_total;
    public $paid_amount;
    public $fine;
    public $return;
    public $remaining_amount;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->price = $project->valid_price;
        $this->grand_total = $project->grand_total ?? 0;
        $this->paid_amount = $project->paid_amount;
        $this->fine = $project->fine;
        $this->remaining_amount = $project->remaining_amount;
    }

    public function updatedReturn()
    {
        if ($this->return > $this->paid_amount) {
            $this->emit('return_amount_exceeded');
        } else {
            $this->remaining_amount = ($this->grand_total) - (($this->paid_amount ?? 0) - ($this->return ?? 0));
        }
    }

    public function render()
    {
        return view('livewire.admin.project.project-return');
    }
}
