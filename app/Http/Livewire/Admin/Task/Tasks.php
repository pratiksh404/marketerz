<?php

namespace App\Http\Livewire\Admin\Task;

use Livewire\Component;
use App\Models\Admin\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Tasks extends Component
{
    public $task;
    public $description;
    public $deadline;
    public $reminder;
    public $reminder_date_time;
    public $channel = [];
    public $user_id;

    protected $rules = [
        'task' => 'required|max:255',
        'description' => 'nullable|max:3000',
        'deadline' => 'nullable',
        'reminder' => 'sometimes|boolean',
        'reminder_date_time' => 'required_if:reminder,1',
        'channel' => 'required_if:reminder,1',
    ];

    public function submit()
    {
        $this->validate();
        $task = Task::create([
            'task' => $this->task,
            'description' => $this->description,
            'deadline' => isset($this->deadline) ? Carbon::createFromFormat('Y-m-d', $this->deadline) : Carbon::now(),
            'reminder' => $this->reminder,
            'reminder_date_time' => isset($this->reminder_date_time) ? Carbon::createFromFormat('Y-m-d', $this->deadline) : null,
            'channel' => $this->channel,
            'user_id' => Auth::user()->id,
            'status' => 0
        ]);
        $this->emit('taskCreated');
    }

    public function render()
    {
        $this->emit('initializeTask');
        $tasks = Cache::get('tasks', Task::latest()->get());
        return view('livewire.admin.task.tasks', compact('tasks'));
    }
}
