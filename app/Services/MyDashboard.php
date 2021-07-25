<?php

namespace App\Services;

use App\Models\Admin\Lead;
use App\Models\Admin\Task;
use App\Models\Admin\Project;
use Pratiksh\Adminetic\Contracts\DashboardInterface;

class MyDashboard implements DashboardInterface
{
    public function view()
    {
        $view = view()->exists('admin.dashboard.index') ? 'admin.dashboard.index' : 'adminetic::admin.dashboard.index';
        $projects = Project::latest()->get();
        $tasks = Task::where('user_id', auth()->user()->id)->orWhere('assigned_to', auth()->user()->id)->latest()->take(6)->get();
        $leads = Lead::latest()->take(6)->get();

        return view($view, compact('projects', 'tasks', 'leads'));
    }
}
