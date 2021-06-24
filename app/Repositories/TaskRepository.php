<?php

namespace App\Repositories;

use App\Models\Admin\Task;
use Illuminate\Support\Facades\Cache;
use App\Contracts\TaskRepositoryInterface;
use App\Http\Requests\TaskRequest;

class TaskRepository implements TaskRepositoryInterface
{
    // Task Index
    public function indexTask()
    {
        $tasks = config('coderz.caching', true)
            ? (Cache::has('tasks') ? Cache::get('tasks') : Cache::rememberForever('tasks', function () {
                return Task::latest()->get();
            }))
            : Task::latest()->get();
        return compact('tasks');
    }

    // Task Create
    public function createTask()
    {
        //
    }

    // Task Store
    public function storeTask(TaskRequest $request)
    {
        Task::create($request->validated());
    }

    // Task Show
    public function showTask(Task $task)
    {
        return compact('task');
    }

    // Task Edit
    public function editTask(Task $task)
    {
        return compact('task');
    }

    // Task Update
    public function updateTask(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
    }

    // Task Destroy
    public function destroyTask(Task $task)
    {
        $task->delete();
    }
}
