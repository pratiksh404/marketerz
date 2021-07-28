<?php

namespace App\Http\Livewire\Admin\Report;

use Carbon\Carbon;
use Livewire\Component;
use App\Facades\Marketerz;
use App\Models\Admin\Client;
use Illuminate\Support\Facades\Cache;

class TransactionReport extends Component
{
    public $startdate;
    public $enddate;
    public $clientid = null;

    protected $listeners = ['transaction_report_range_date' => 'transactionReportRangeDate'];

    public function mount()
    {
        $this->startdate = Carbon::now()->format('Y-m-d');
        $this->enddate = Carbon::now()->format('Y-m-d');
    }

    public function updatedClientid()
    {
        $this->emit('transaction_report_generated');
    }

    public function transactionReportRangeDate($startdate, $enddate)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
        $this->emit('transaction_report_generated');
    }

    public function render()
    {
        $transactions = Marketerz::transactionReport($this->startdate, $this->enddate, $this->clientid);
        $total = Marketerz::transactionTotalReport($this->startdate, $this->enddate, $this->clientid);
        $clients = Cache::get('clients', Client::latest()->get());
        return view('livewire.admin.report.transaction-report', compact('clients', 'transactions', 'total'));
    }
}
