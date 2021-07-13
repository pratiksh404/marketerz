<?php

namespace App\Http\Livewire\Admin\Service;

use Livewire\Component;
use App\Models\Admin\Service;

class QuickService extends Component
{
    public $model;

    public $name;
    public $type;
    public $price;

    protected $rules = [
        'name' => 'required|max:255',
        'type' => 'nullable|numeric',
        'price' => 'nullable|numeric'
    ];

    public function mount($model = null)
    {
        $this->model = $model;
    }

    public function submit()
    {

        $this->validate();

        Service::create([
            'name' => $this->name,
            'active' => 1,
            'type' => $this->type ?? 1,
            'price' => $this->price ?? 0
        ]);
        $this->emit('quick_service_created');

        $this->reset();
    }

    public function render()
    {
        $services = Service::latest()->get();
        return view('livewire.admin.service.quick-service', compact('services'));
    }
}
