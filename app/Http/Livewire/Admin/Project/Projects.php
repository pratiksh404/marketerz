<?php

namespace App\Http\Livewire\Admin\Project;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Lead;
use App\Models\Admin\Client;
use Livewire\WithPagination;
use App\Models\Admin\Package;
use App\Models\Admin\Project;
use App\Models\Admin\Department;
use Illuminate\Support\Facades\Cache;

class Projects extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['client_projects' => 'clientProjects', 'lead_projects' => 'leadProjects', 'package_projects' => 'packageProjects', 'department_projects' => 'departmentProjects', 'project_head_projects' => 'projectHeadProjects', 'user_projects' => 'userProjects', 'date_range_filter' => 'dateRangeFilter'];

    public $filter = 1;
    public $clientid;
    public $leadid;
    public $packageid;
    public $departmentid;
    public $projectheadid;
    public $userid;
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->filter = 1;
    }

    public function getAllProjects()
    {
        $this->filter = 1;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function clientProjects($clientid)
    {
        $this->filter = 2;
        $this->clientid = $clientid;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function leadProjects($leadid)
    {
        $this->filter = 3;
        $this->leadid = $leadid;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function packageProjects($packageid)
    {
        $this->filter = 4;
        $this->packageid = $packageid;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function departmentProjects($departmentid)
    {
        $this->filter = 5;
        $this->departmentid = $departmentid;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function projectHeadProjects($projectheadid)
    {
        $this->filter = 6;
        $this->projectheadid = $projectheadid;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function userProjects($userid)
    {
        $this->filter = 7;
        $this->userid = $userid;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function getRunningProject()
    {
        $this->filter = 8;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function getCanceledProject()
    {
        $this->filter = 9;
        $this->emit('initialize_projects');
        $this->resetPage();
    }
    public function dateRangeFilter($startDate, $endDate)
    {
        $this->filter = 10;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->emit('initialize_projects');
        $this->resetPage();
    }

    public function render()
    {
        $projects = $this->getProjects();
        $clients = Cache::get('clients', Client::latest()->get());
        $leads = Cache::get('leads', Lead::latest()->get());
        $packages = Cache::get('packages', Package::latest()->get());
        $departments = Cache::get('departments', Department::latest()->get());
        $project_heads = Cache::get('users', User::latest()->get());
        $users = $project_heads;

        return view('livewire.admin.project.projects', compact('projects', 'clients', 'leads', 'packages', 'departments', 'project_heads', 'users'));
    }

    protected function getProjects()
    {
        $projects = null;
        $filter = $this->filter;
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin') && auth()->user()->userCanDo('Project', 'browse')) {
            $default = Project::with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services');
        } else {
            $default = Project::with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->orWhere('project_head', auth()->user()->id);
        }
        if ($filter == 1) {
            $projects = $default->latest();
        } elseif ($filter == 2) {
            $projects = $default->where('client_id', $this->clientid)->latest();
        } elseif ($filter == 3) {
            $projects = $default->where('lead_id', $this->leadid)->latest();
        } elseif ($filter == 4) {
            $projects = $default->where('package_id', $this->packageid)->latest();
        } elseif ($filter == 5) {
            $projects = $default->where('department_id', $this->departmentid)->latest();
        } elseif ($filter == 6) {
            $projects = $default->where('project_head', $this->projectheadid)->latest();
        } elseif ($filter == 7) {
            $projects = $default->where('user_id', $this->userid)->latest();
        } elseif ($filter == 8) {
            $projects = $default->where('project_deadline', '>', Carbon::now())->latest();
        } elseif ($filter == 9) {
            $projects = $default->where('cancel', 1)->latest();
        } else {
            $projects = $default->latest();
        }
        return $projects->paginate(9);
    }
}
