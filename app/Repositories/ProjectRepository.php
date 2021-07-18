<?php

namespace App\Repositories;

use App\Models\User;

use App\Models\Admin\Package;
use App\Models\Admin\Project;
use App\Models\Admin\Department;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Cache;
use App\Contracts\ProjectRepositoryInterface;
use App\Events\ProjectInitializedEvent;

class ProjectRepository implements ProjectRepositoryInterface
{
    // Project Index
    public function indexProject()
    {
        $projects = config('coderz.caching', true)
            ? (Cache::has('projects') ? Cache::get('projects') : Cache::rememberForever('projects', function () {
                return             Project::with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest()->paginate(9);
            }))
            : Project::with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest()->paginate(9);
        return [];
    }

    // Project Create
    public function createProject()
    {
        $packages = Cache::get('package', Package::latest()->get());
        $users = Cache::get('users', User::latest()->get());
        $departments = Cache::get('departments', Department::latest()->get());
        return compact('packages', 'users', 'departments');
    }

    // Project Store
    public function storeProject(ProjectRequest $request)
    {
        $project = Project::create($request->validated());
        event(new ProjectInitializedEvent(1, $project));
    }

    // Project Show
    public function showProject(Project $project)
    {
        return compact('project');
    }

    // Project Edit
    public function editProject(Project $project)
    {
        $packages = Cache::get('package', Package::latest()->get());
        $users = Cache::get('users', User::latest()->get());
        $departments = Cache::get('departments', Department::latest()->get());
        return compact('project', 'packages', 'users', 'departments');
    }

    // Project Update
    public function updateProject(ProjectRequest $request, Project $project)
    {
        $old_lead_id = $project->lead_id ?? null;
        $project->update($request->validated());
        event(new ProjectInitializedEvent(2, $project, $old_lead_id));
    }

    // Project Destroy
    public function destroyProject(Project $project)
    {
        $project->delete();
    }

    // Convert To Client
    public function convertToClient($lead_id)
    {
        $packages = Cache::get('package', Package::latest()->get());
        $users = Cache::get('users', User::latest()->get());
        $departments = Cache::get('departments', Department::latest()->get());
        return compact('packages', 'users', 'departments', 'lead_id');
    }
}
