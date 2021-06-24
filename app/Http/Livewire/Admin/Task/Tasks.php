<?php

namespace App\Http\Livewire\Admin\Task;

use Livewire\Component;
use App\Models\Admin\Task;
use Illuminate\Support\Facades\Cache;

class Tasks extends Component
{
    public function render()
    {
        $tasks = Cache::get('tasks', Task::latest()->get());
        return view('livewire.admin.task.tasks', compact('tasks'));
    }
}
