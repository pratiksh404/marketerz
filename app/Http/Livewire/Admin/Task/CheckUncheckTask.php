<?php

namespace App\Http\Livewire\Admin\Task;

use Livewire\Component;
use App\Models\Admin\Task;

class CheckUncheckTask extends Component
{
    public $task;
    public $status;

    protected $listeners = ['change_status' => 'changeStatus'];

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->status = $task->status;
    }

    public function changeStatus()
    {
        $this->task->update([
            'status' => !$this->status
        ]);
        $this->status = $this->task->status;
        $this->emit('status_updated');
    }

    public function render()
    {
        return view('livewire.admin.task.check-uncheck-task');
    }
}
