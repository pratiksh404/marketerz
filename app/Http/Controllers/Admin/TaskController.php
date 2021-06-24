<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Contracts\TaskRepositoryInterface;

class TaskController extends Controller
{
    protected $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepositoryInterface = $taskRepositoryInterface;
        $this->authorizeResource(Task::class, 'task');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.task.index', $this->taskRepositoryInterface->indexTask());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $this->taskRepositoryInterface->storeTask($request);
        return redirect(adminRedirectRoute('task'))->withSuccess('Task Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('admin.task.show', $this->taskRepositoryInterface->showTask($task));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('admin.task.edit', $this->taskRepositoryInterface->editTask($task));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @param  \App\Models\Admin\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->taskRepositoryInterface->updateTask($request, $task);
        return redirect(adminRedirectRoute('task'))->withInfo('Task Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->taskRepositoryInterface->destroyTask($task);
        return redirect(adminRedirectRoute('task'))->withFail('Task Deleted Successfully.');
    }
}
