<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;
use App\Contracts\ProjectRepositoryInterface;
use App\Events\PaymentEvent;
use App\Http\Requests\PaymentRequest;

class ProjectController extends Controller
{
    protected $projectRepositoryInterface;

    public function __construct(ProjectRepositoryInterface $projectRepositoryInterface)
    {
        $this->projectRepositoryInterface = $projectRepositoryInterface;
        $this->authorizeResource(Project::class, 'project');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.project.index', $this->projectRepositoryInterface->indexProject());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create', $this->projectRepositoryInterface->createProject());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $this->projectRepositoryInterface->storeProject($request);
        return redirect(adminRedirectRoute('project'))->withSuccess('Project Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.project.show', $this->projectRepositoryInterface->showProject($project));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.project.edit', $this->projectRepositoryInterface->editProject($project));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->projectRepositoryInterface->updateProject($request, $project);
        return redirect(adminRedirectRoute('project'))->withInfo('Project Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->projectRepositoryInterface->destroyProject($project);
        return redirect(adminRedirectRoute('project'))->withFail('Project Deleted Successfully.');
    }

    /**
     *
     * Project Payment
     *
     */
    public function project_payment(Project $project)
    {
        return view('admin.project.project_payment', compact('project'));
    }

    /**
     *
     * Store Project Payment
     *
     */
    public function store_project_payment(Project $project, PaymentRequest $request)
    {
        event(new PaymentEvent(1, $project, $request));
        return redirect()->back()->withInfo('Project Payment Successfull');
    }
    /**
     *
     * Project Return
     *
     */
    public function project_return(Project $project)
    {
        return view('admin.project.project_return', compact('project'));
    }

    /**
     *
     * Store Project Return
     *
     */
    public function store_project_return(Project $project, ReturnRequest $request)
    {
        event(new ReturnEvent(1, $project, $request));
        return redirect()->back()->withInfo('Project Return Successfull');
    }
}
