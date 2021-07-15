<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Admin\Package;
use App\Models\Admin\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Cache;
use App\Contracts\ProjectRepositoryInterface;
use App\Models\Admin\Department;

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
        Project::create($request->validated());
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
        $project->update($request->validated());
    }

    // Project Destroy
    public function destroyProject(Project $project)
    {
        $project->delete();
    }
}
