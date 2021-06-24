<?php

namespace App\Contracts;

use App\Models\Admin\Task;
use App\Http\Requests\TaskRequest;

interface TaskRepositoryInterface
{
    public function indexTask();

    public function createTask();

    public function storeTask(TaskRequest $request);

    public function showTask(Task $Task);

    public function editTask(Task $Task);

    public function updateTask(TaskRequest $request, Task $Task);

    public function destroyTask(Task $Task);
}
