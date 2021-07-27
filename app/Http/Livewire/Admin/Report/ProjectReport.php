<?php

namespace App\Http\Livewire\Admin\Report;

use Carbon\Carbon;
use Livewire\Component;
use App\Facades\Marketerz;
use App\Models\Admin\Client;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Cache;

class ProjectReport extends Component
{
    public $report_type = 1;
    public $clientid = null;
    public $filter;
    public $totalreportlastdays = 1;
    public $totalreportlastmonths = 1;
    public $startdate;
    public $enddate;
    public $year;

    protected $listeners = ['project_report_range_date' => 'projectReportRangeDate'];

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->filter = 1;
        $this->clientid = null;
    }

    public function todayProjects()
    {
        $this->filter = 1;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function yesterdayProjects()
    {
        $this->filter = 2;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function thisWeekProjects()
    {
        $this->filter = 3;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function thisMonthProjects()
    {
        $this->filter = 4;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function thisYearProjects()
    {
        $this->filter = 5;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function updatedTotalreportlastdays()
    {
        $this->filter = 6;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function updatedTotalreportlastMonths()
    {
        $this->filter = 7;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function projectReportRangeDate($startdate, $enddate)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->filter = 8;
        $this->report_type = 1;
        $this->emit('project_report_generated');
    }

    public function clearClient()
    {
        $this->clientid = null;
        $this->emit('project_report_generated');
    }

    public function render()
    {
        $projects = $this->getProjectProjectReport()['projects'];
        $project_report = $this->getProjectProjectReport()['project_report'];
        $monthly_project_report = $this->getProjectMonthlyYearlyProjectReport(1);
        $yearly_project_report = $this->getProjectMonthlyYearlyProjectReport(2);
        $description =  $this->getProjectProjectReport()['description'];
        $date =  $this->getProjectProjectReport()['date'];
        $clients = Cache::get('clients', Client::latest()->get());
        return view('livewire.admin.report.project-report', compact('projects', 'project_report', 'monthly_project_report', 'yearly_project_report', 'description', 'date', 'clients'));
    }

    protected function getProjectMonthlyYearlyProjectReport($type)
    {
        $year = $this->year ?? Carbon::now()->year;
        $clientid = $this->clientid != null && $this->clientid != '' ? $this->clientid : null;
        if (isset($clientid)) {
            $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereYear('created_at', $year)->where('client_id', $clientid);
        } else {
            $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereYear('created_at', $year);
        }
        return Marketerz::projectReport($projects, $type == 1 ? 3 : 4, 2);
    }

    protected function getProjectProjectReport()
    {
        $filter = $this->filter;
        $projects = null;
        $project_report = null;
        $description = null;
        $date = null;
        $clientid = $this->clientid != null && $this->clientid != '' ? $this->clientid : null;
        switch ($filter) {
            case 1:
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereDate('created_at', Carbon::now());
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereDate('created_at', Carbon::now());
                }
                $description = "Today's Project Report";
                $date = Carbon::now()->toFormattedDateString();
                break;
            case 2:
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereDate('created_at', Carbon::now()->subDay());
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereDate('created_at', Carbon::now()->subDay());
                }
                $description = "Yesterday's Project Report";
                $date = Carbon::now()->subDay()->toFormattedDateString();
                break;
            case 3:
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                $description = "This Week's Project Report";
                $date = Carbon::now()->startOfWeek()->toFormattedDateString() . ' to ' . Carbon::now()->endOfWeek()->toFormattedDateString();
                break;
            case 4:
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfmonth(), Carbon::now()->endOfmonth()]);
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereBetween('created_at', [Carbon::now()->startOfmonth(), Carbon::now()->endOfmonth()]);
                }
                $description = "This Month's Project Report";
                $date = Carbon::now()->startOfMonth()->toFormattedDateString() . ' to ' . Carbon::now()->endOfMonth()->toFormattedDateString();
                break;
            case 5:
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfyear(), Carbon::now()->endOfyear()]);
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereBetween('created_at', [Carbon::now()->startOfyear(), Carbon::now()->endOfyear()]);
                }
                $description = "This Year's Project Report";
                $date = Carbon::now()->startOfYear()->toFormattedDateString() . ' to ' . Carbon::now()->endOfYear()->toFormattedDateString();
                break;
            case 6:
                $totalreportlastdays = $this->totalreportlastdays != null ? $this->totalreportlastdays : 1;
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->subDays($totalreportlastdays), Carbon::now()]);
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereBetween('created_at', [Carbon::now()->subDays($totalreportlastdays), Carbon::now()]);
                }
                $description = "Last " . $totalreportlastdays . " days Project Report";
                $date = Carbon::now()->subDays($totalreportlastdays)->toFormattedDateString() . ' to ' . Carbon::now()->toFormattedDateString();
                break;
            case 7:
                $totalreportlastmonths = $this->totalreportlastmonths != null ? $this->totalreportlastmonths : 1;
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->subMonths($totalreportlastmonths), Carbon::now()]);
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereBetween('created_at', [Carbon::now()->subMonths($totalreportlastmonths), Carbon::now()]);
                }
                $description = "Last " . $totalreportlastmonths . " Months Project Report";
                $date = Carbon::now()->subMonths($totalreportlastmonths)->toFormattedDateString() . ' to ' . Carbon::now()->toFormattedDateString();
                break;
            case 8:
                $startdate = $this->startdate != null ? Carbon::create($this->startdate) : Carbon::now();
                $enddate = $this->enddate != null ? Carbon::create($this->enddate) : Carbon::now();
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->whereBetween('created_at', [$startdate, $enddate]);
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->whereBetween('created_at', [$startdate, $enddate]);
                }
                $description = $startdate->toFormattedDateString() . ' to ' . $enddate->toFormattedDateString();
                $date = null;
                break;
            default:
                if (isset($clientid)) {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->where('client_id', $clientid)->latest();
                } else {
                    $projects = Project::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->latest();
                }
                $description = "Today's Project Report";
                $date = Carbon::now()->toFormattedDateString();
        }
        return [
            'projects' => $projects->get(),
            'project_report' => Marketerz::projectReport($projects, 1),
            'description' => $description,
            'date' => $date
        ];
    }
}
