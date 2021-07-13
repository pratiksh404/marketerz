<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Admin\Service;
use Livewire\Component;

class ServicePlan extends Component
{
    public $selected_service;
    public $unit = 1;
    public $price = 0;

    public function mount(Service $selected_service)
    {
        $this->selected_service = $selected_service;
        $this->price = $selected_service->price;
    }

    public function updatedUnit()
    {
        $this->price = $this->selected_service->price * $this->unit;
    }

    public function render()
    {
        return view('livewire.admin.package.service-plan');
    }
}
