<?php

namespace App\Http\Livewire\Admin\Package;

use Livewire\Component;
use App\Models\Admin\Service;
use Illuminate\Support\Facades\Cache;

class Services extends Component
{
    public $model;
    public $checkedservices = [];
    public $selectedservices = [];

    public function mount($model = null)
    {
        $this->model = $model;
        $this->checkedservices = $model ? $model->services : null;
    }

    public function render()
    {
        $services = Service::latest()->get();
        $selected_services = Service::find($this->checkedservices);
        return view('livewire.admin.package.services', compact('services', 'selected_services'));
    }
}
