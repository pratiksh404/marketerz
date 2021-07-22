<?php

namespace App\Http\Livewire\Admin\Client;

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

class ClientProjects extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['lead_projects' => 'leadProjects', 'package_projects' => 'packageProjects', 'department_projects' => 'departmentProjects', 'project_head_projects' => 'projectHeadProjects', 'user_projects' => 'userProjects', 'date_range_filter' => 'dateRangeFilter'];

    public $filter = 1;
    public $clientid;
    public $leadid;
    public $packageid;
    public $departmentid;
    public $projectheadid;
    public $userid;
    public $startDate;
    public $endDate;

    public function mount($clientid)
    {
        $this->filter = 1;
        $this->clientid = $clientid;
    }

    public function getAllProjects()
    {
        $this->filter = 1;
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
        $leads = Cache::get('leads', Lead::latest()->get());
        $packages = Cache::get('packages', Package::latest()->get());
        $departments = Cache::get('departments', Department::latest()->get());
        $project_heads = Cache::get('users', User::latest()->get());
        $users = $project_heads;

        return view('livewire.admin.client.client-projects', compact('projects', 'leads', 'packages', 'departments', 'project_heads', 'users'));
    }

    protected function getProjects()
    {
        $projects = null;
        $filter = $this->filter;
        $default = Project::with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        if ($filter == 1) {
            $projects = $default;
        } elseif ($filter == 2) {
            $projects = Project::where('client_id', $this->clientid)->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } elseif ($filter == 3) {
            $projects = Project::where('client_id', $this->clientid)->where('lead_id', $this->leadid)->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } elseif ($filter == 4) {
            $projects = Project::where('client_id', $this->clientid)->where('package_id', $this->packageid)->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } elseif ($filter == 5) {
            $projects = Project::where('client_id', $this->clientid)->where('department_id', $this->departmentid)->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } elseif ($filter == 6) {
            $projects = Project::where('client_id', $this->clientid)->where('project_head', $this->projectheadid)->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } elseif ($filter == 7) {
            $projects = Project::where('client_id', $this->clientid)->where('user_id', $this->userid)->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } elseif ($filter == 8) {
            $projects = Project::where('client_id', $this->clientid)->where('project_deadline', '>', Carbon::now())->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } elseif ($filter == 9) {
            $projects = Project::where('client_id', $this->clientid)->where('cancel', 1)->with('user', 'client', 'lead', 'package', 'department', 'projectHead', 'services')->latest();
        } else {
            $projects = $default;
        }
        return $projects->paginate(9);
    }
}
