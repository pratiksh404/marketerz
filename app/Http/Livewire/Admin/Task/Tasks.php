<?php

namespace App\Http\Livewire\Admin\Task;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Task;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Tasks extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filter = 1;

    public $readyTask = false;

    public $task;
    public $description;
    public $deadline;
    public $reminder;
    public $reminder_date_time;
    public $channel = [];
    public $user_id;
    public $assigned_to = '';

    protected $rules = [
        'task' => 'required|max:255',
        'description' => 'nullable|max:3000',
        'deadline' => 'nullable',
        'reminder' => 'sometimes|boolean',
        'reminder_date_time' => 'required_if:reminder,1',
        'channel' => 'required_if:reminder,1',
        'assigned_to' => 'nullable|numeric'
    ];

    protected $listeners = ['delete_task' => 'deleteTask', 'status_updated' => '$refresh'];

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
            'assigned_to' => $this->assigned_to != '' ? $this->assigned_to : null,
            'status' => 0
        ]);
        $this->emit('taskCreated');
    }

    public function loadTask()
    {
        $this->readyTask = true;
    }

    public function deleteTask($task_id)
    {
        $task = Task::find($task_id);
        if (isset($task)) {
            $task->delete();
        }
        $this->emit('task_deleted');
        $this->resetPage();
    }

    public function allTasks()
    {
        $this->filter = 1;
        $this->resetPage();
    }

    public function todayTasks()
    {
        $this->filter = 2;
        $this->resetPage();
    }

    public function delayedTasks()
    {
        $this->filter = 3;
        $this->resetPage();
    }

    public function upcomingTasks()
    {
        $this->filter = 4;
        $this->resetPage();
    }

    public function weekTasks()
    {
        $this->filter = 5;
        $this->resetPage();
    }

    public function monthTasks()
    {
        $this->filter = 6;
        $this->resetPage();
    }

    public function assignedTo()
    {
        $this->filter = 7;
        $this->resetPage();
    }

    public function render()
    {
        $this->emit('initializeTask');
        $tasks = $this->readyTask ? $this->getTask() : null;
        $users = Cache::get('users', User::latest()->get());
        return view('livewire.admin.task.tasks', compact('tasks', 'users'));
    }

    public function getTask()
    {
        $filter = $this->filter;
        if ($filter == 1) {
            return Task::tenent()->latest()->paginate(10);
        } elseif ($filter == 2) {
            return Task::tenent()->whereDate('created_at', Carbon::today()->toDateString())->latest()->paginate(10);
        } elseif ($filter == 3) {
            return Task::tenent()->whereDate('created_at', '<', Carbon::today()->toDateString())->latest()->paginate(10);
        } elseif ($filter == 4) {
            return Task::tenent()->whereDate('created_at', '>', Carbon::today()->toDateString())->latest()->paginate(10);
        } elseif ($filter == 5) {
            $today = Carbon::now();
            $startOfWeek = $today->startOfWeek();
            $endOfWeek = $today->endOfWeek();
            return Task::tenent()->whereBetween('created_at', [$startOfWeek, $endOfWeek])->latest()->paginate(10);
        } elseif ($filter == 6) {
            $today = Carbon::now();
            $startOfYear = $today->startOfYear();
            $endOfYear = $today->endOfYear();
            return Task::tenent()->whereBetween('created_at', [$startOfYear, $endOfYear])->latest()->paginate(10);
        } elseif ($filter == 7) {
            return Task::where('assigned_to', Auth::user()->id)->latest()->paginate(10);
        }
    }
}
