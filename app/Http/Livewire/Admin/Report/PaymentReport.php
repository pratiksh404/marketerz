<?php

namespace App\Http\Livewire\Admin\Report;

use Carbon\Carbon;
use Livewire\Component;
use App\Facades\Marketerz;
use App\Models\Admin\Client;
use App\Models\Admin\Payment;
use Illuminate\Support\Facades\Cache;

class PaymentReport extends Component
{
    public $type = 1;
    public $report_type = 1;
    public $clientid = null;
    public $filter;
    public $totalreportlastdays = 1;
    public $totalreportlastmonths = 1;
    public $startdate;
    public $enddate;
    public $year;

    protected $listeners = ['report_range_date' => 'reportRangeDate'];

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->filter = 1;
        $this->clientid = null;
    }

    public function todayPayments()
    {
        $this->filter = 1;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function yesterdayPayments()
    {
        $this->filter = 2;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function thisWeekPayments()
    {
        $this->filter = 3;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function thisMonthPayments()
    {
        $this->filter = 4;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function thisYearPayments()
    {
        $this->filter = 5;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function updatedTotalreportlastdays()
    {
        $this->filter = 6;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function updatedTotalreportlastMonths()
    {
        $this->filter = 7;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function reportRangeDate($startdate, $enddate)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->filter = 8;
        $this->report_type = 1;
        $this->emit('payment_report_generated');
    }

    public function clearClient()
    {
        $this->clientid = null;
        $this->emit('payment_report_generated');
    }

    public function render()
    {
        $payment_report = $this->type == 1 ? $this->getProjectPaymentReport()['payment_report'] : null;
        $monthly_payment_report = $this->type == 1 ? $this->getProjectMonthlyYearlyPaymentReport(1) : null;
        $yearly_payment_report = $this->type == 1 ? $this->getProjectMonthlyYearlyPaymentReport(2) : null;
        $description = $this->type == 1 ?  $this->getProjectPaymentReport()['description'] : null;
        $date = $this->type == 1 ?  $this->getProjectPaymentReport()['date'] : null;
        $clients = Cache::get('clients', Client::latest()->get());
        return view('livewire.admin.report.payment-report', compact('payment_report', 'monthly_payment_report', 'yearly_payment_report', 'description', 'date', 'clients'));
    }

    protected function getProjectMonthlyYearlyPaymentReport($type)
    {
        $year = $this->year ?? Carbon::now()->year;
        $clientid = $this->clientid != null && $this->clientid != '' ? $this->clientid : null;
        if (isset($clientid)) {
            $payments = Payment::whereYear('created_at', $year)->where('client_id', $clientid);
        } else {
            $payments = Payment::whereYear('created_at', $year);
        }
        return Marketerz::paymentReport($payments, $type == 1 ? 3 : 4, 2);
    }

    protected function getProjectPaymentReport()
    {
        $filter = $this->filter;
        $payments = null;
        $payment_report = null;
        $description = null;
        $date = null;
        $clientid = $this->clientid != null && $this->clientid != '' ? $this->clientid : null;
        switch ($filter) {
            case 1:
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereDate('created_at', Carbon::now());
                } else {
                    $payments = Payment::whereDate('created_at', Carbon::now());
                }
                $description = "Today's Payment Report";
                $date = Carbon::now()->toFormattedDateString();
                break;
            case 2:
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereDate('created_at', Carbon::now()->subDay());
                } else {
                    $payments = Payment::whereDate('created_at', Carbon::now()->subDay());
                }
                $description = "Yesterday's Payment Report";
                $date = Carbon::now()->subDay()->toFormattedDateString();
                break;
            case 3:
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                } else {
                    $payments = Payment::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                $description = "This Week's Payment Report";
                $date = Carbon::now()->startOfWeek()->toFormattedDateString() . ' to ' . Carbon::now()->endOfWeek()->toFormattedDateString();
                break;
            case 4:
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfmonth(), Carbon::now()->endOfmonth()]);
                } else {
                    $payments = Payment::whereBetween('created_at', [Carbon::now()->startOfmonth(), Carbon::now()->endOfmonth()]);
                }
                $description = "This Month's Payment Report";
                $date = Carbon::now()->startOfMonth()->toFormattedDateString() . ' to ' . Carbon::now()->endOfMonth()->toFormattedDateString();
                break;
            case 5:
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->startOfyear(), Carbon::now()->endOfyear()]);
                } else {
                    $payments = Payment::whereBetween('created_at', [Carbon::now()->startOfyear(), Carbon::now()->endOfyear()]);
                }
                $description = "This Year's Payment Report";
                $date = Carbon::now()->startOfYear()->toFormattedDateString() . ' to ' . Carbon::now()->endOfYear()->toFormattedDateString();
                break;
            case 6:
                $totalreportlastdays = $this->totalreportlastdays != null ? $this->totalreportlastdays : 1;
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->subDays($totalreportlastdays), Carbon::now()]);
                } else {
                    $payments = Payment::whereBetween('created_at', [Carbon::now()->subDays($totalreportlastdays), Carbon::now()]);
                }
                $description = "Last " . $totalreportlastdays . " days Payment Report";
                $date = Carbon::now()->subDays($totalreportlastdays)->toFormattedDateString() . ' to ' . Carbon::now()->toFormattedDateString();
                break;
            case 7:
                $totalreportlastmonths = $this->totalreportlastmonths != null ? $this->totalreportlastmonths : 1;
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereBetween('created_at', [Carbon::now()->subMonths($totalreportlastmonths), Carbon::now()]);
                } else {
                    $payments = Payment::whereBetween('created_at', [Carbon::now()->subMonths($totalreportlastmonths), Carbon::now()]);
                }
                $description = "Last " . $totalreportlastmonths . " Months Payment Report";
                $date = Carbon::now()->subMonths($totalreportlastmonths)->toFormattedDateString() . ' to ' . Carbon::now()->toFormattedDateString();
                break;
            case 8:
                $startdate = $this->startdate != null ? Carbon::create($this->startdate) : Carbon::now();
                $enddate = $this->enddate != null ? Carbon::create($this->enddate) : Carbon::now();
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->whereBetween('created_at', [$startdate, $enddate]);
                } else {
                    $payments = Payment::whereBetween('created_at', [$startdate, $enddate]);
                }
                $description = $startdate->toFormattedDateString() . ' to ' . $enddate->toFormattedDateString();
                $date = null;
                break;
            default:
                if (isset($clientid)) {
                    $payments = Payment::where('client_id', $clientid)->latest();
                } else {
                    $payments = Payment::latest();
                }
                $description = "Today's Payment Report";
                $date = Carbon::now()->toFormattedDateString();
        }
        return [
            'payment_report' => Marketerz::paymentReport($payments, 1),
            'description' => $description,
            'date' => $date
        ];
    }
}
