<?php

namespace App\Http\Livewire\Admin\Report;

use Carbon\Carbon;
use Livewire\Component;
use App\Facades\Marketerz;
use App\Models\Admin\Client;
use App\Models\Admin\Advance;
use Illuminate\Support\Facades\Cache;

class AdvanceReport extends Component
{
    public $report_type = 1;
    public $clientid = null;
    public $filter;
    public $totalreportlastdays = 1;
    public $totalreportlastmonths = 1;
    public $startdate;
    public $enddate;
    public $year;

    protected $listeners = ['advance_report_range_date' => 'advanceReportRangeDate'];

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->filter = 1;
        $this->clientid = null;
    }

    public function todayAdvances()
    {
        $this->filter = 1;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function yesterdayAdvances()
    {
        $this->filter = 2;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function thisWeekAdvances()
    {
        $this->filter = 3;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function thisMonthAdvances()
    {
        $this->filter = 4;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function thisYearAdvances()
    {
        $this->filter = 5;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function updatedTotalreportlastdays()
    {
        $this->filter = 6;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function updatedTotalreportlastMonths()
    {
        $this->filter = 7;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function advanceReportRangeDate($startdate, $enddate)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->filter = 8;
        $this->report_type = 1;
        $this->emit('advance_report_generated');
    }

    public function clearClient()
    {
        $this->clientid = null;
        $this->emit('advance_report_generated');
    }

    public function render()
    {
        $advances = $this->getProjectAdvanceReport()['advances'];
        $advance_report = $this->getProjectAdvanceReport()['advance_report'];
        $monthly_advance_report = $this->getProjectMonthlyYearlyAdvanceReport(1);
        $yearly_advance_report = $this->getProjectMonthlyYearlyAdvanceReport(2);
        $description = $this->getProjectAdvanceReport()['description'];
        $date = $this->getProjectAdvanceReport()['date'];
        $clients = Cache::get('clients', Client::latest()->get());
        return view('livewire.admin.report.advance-report', compact('advances', 'advance_report', 'monthly_advance_report', 'yearly_advance_report', 'description', 'date', 'clients'));
    }

    protected function getProjectMonthlyYearlyAdvanceReport($type)
    {
        $year = $this->year ?? Carbon::now()->year;
        $clientid = $this->clientid != null && $this->clientid != '' ? $this->clientid : null;
        if (isset($clientid)) {
            $advances = Advance::with('user', 'client')->whereYear('created_at', $year)->where('client_id', $clientid);
        } else {
            $advances = Advance::with('user', 'client')->whereYear('created_at', $year);
        }
        return Marketerz::advanceReport($advances, $type == 1 ? 3 : 4, 2);
    }

    protected function getProjectAdvanceReport()
    {
        $filter = $this->filter;
        $advances = null;
        $advance_report = null;
        $description = null;
        $date = null;
        $clientid = $this->clientid != null && $this->clientid != '' ? $this->clientid : null;
        switch ($filter) {
            case 1:
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereDate('created_at', Carbon::now());
                } else {
                    $advances = Advance::with('user', 'client')->whereDate('created_at', Carbon::now());
                }
                $description = "Today's Advance Report";
                $date = Carbon::now()->toFormattedDateString();
                break;
            case 2:
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereDate('created_at', Carbon::now()->subDay());
                } else {
                    $advances = Advance::with('user', 'client')->whereDate('created_at', Carbon::now()->subDay());
                }
                $description = "Yesterday's Advance Report";
                $date = Carbon::now()->subDay()->toFormattedDateString();
                break;
            case 3:
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                } else {
                    $advances = Advance::with('user', 'client')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                $description = "This Week's Advance Report";
                $date = Carbon::now()->startOfWeek()->toFormattedDateString() . ' to ' . Carbon::now()->endOfWeek()->toFormattedDateString();
                break;
            case 4:
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfmonth(), Carbon::now()->endOfmonth()]);
                } else {
                    $advances = Advance::with('user', 'client')->whereBetween('created_at', [Carbon::now()->startOfmonth(), Carbon::now()->endOfmonth()]);
                }
                $description = "This Month's Advance Report";
                $date = Carbon::now()->startOfMonth()->toFormattedDateString() . ' to ' . Carbon::now()->endOfMonth()->toFormattedDateString();
                break;
            case 5:
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfyear(), Carbon::now()->endOfyear()]);
                } else {
                    $advances = Advance::with('user', 'client')->whereBetween('created_at', [Carbon::now()->startOfyear(), Carbon::now()->endOfyear()]);
                }
                $description = "This Year's Advance Report";
                $date = Carbon::now()->startOfYear()->toFormattedDateString() . ' to ' . Carbon::now()->endOfYear()->toFormattedDateString();
                break;
            case 6:
                $totalreportlastdays = $this->totalreportlastdays != null ? $this->totalreportlastdays : 1;
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->subDays($totalreportlastdays), Carbon::now()]);
                } else {
                    $advances = Advance::with('user', 'client')->whereBetween('created_at', [Carbon::now()->subDays($totalreportlastdays), Carbon::now()]);
                }
                $description = "Last " . $totalreportlastdays . " days Advance Report";
                $date = Carbon::now()->subDays($totalreportlastdays)->toFormattedDateString() . ' to ' . Carbon::now()->toFormattedDateString();
                break;
            case 7:
                $totalreportlastmonths = $this->totalreportlastmonths != null ? $this->totalreportlastmonths : 1;
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->subMonths($totalreportlastmonths), Carbon::now()]);
                } else {
                    $advances = Advance::with('user', 'client')->whereBetween('created_at', [Carbon::now()->subMonths($totalreportlastmonths), Carbon::now()]);
                }
                $description = "Last " . $totalreportlastmonths . " Months Advance Report";
                $date = Carbon::now()->subMonths($totalreportlastmonths)->toFormattedDateString() . ' to ' . Carbon::now()->toFormattedDateString();
                break;
            case 8:
                $startdate = $this->startdate != null ? Carbon::create($this->startdate) : Carbon::now();
                $enddate = $this->enddate != null ? Carbon::create($this->enddate) : Carbon::now();
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->whereBetween('created_at', [$startdate, $enddate]);
                } else {
                    $advances = Advance::with('user', 'client')->whereBetween('created_at', [$startdate, $enddate]);
                }
                $description = $startdate->toFormattedDateString() . ' to ' . $enddate->toFormattedDateString();
                $date = null;
                break;
            default:
                if (isset($clientid)) {
                    $advances = Advance::with('user', 'client')->where('client_id', $clientid)->latest();
                } else {
                    $advances = Advance::with('user', 'client')->latest();
                }
                $description = "Today's Advance Report";
                $date = Carbon::now()->toFormattedDateString();
        }
        return [
            'advances' => $advances->get(),
            'advance_report' => Marketerz::advanceReport($advances, 1),
            'description' => $description,
            'date' => $date
        ];
    }
}
