<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Lead;
use App\Events\ReturnEvent;
use App\Events\PaymentEvent;
use Illuminate\Http\Request;
use App\Models\Admin\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReturnRequest;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\ProjectRequest;
use App\Contracts\ProjectRepositoryInterface;

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
        return redirect(adminRedirectRoute('project'))->withInfo('Project Return Successfull');
    }

    /**
     *
     * Convert To Client
     *
     */
    public function convert_to_client(Lead $lead)
    {
        return view('admin.project.create', $this->projectRepositoryInterface->convertToClient($lead->id));
    }
}
