<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;

class PaymentReport extends Component
{
    public $type = 1;
    public $filter;

    public function render()
    {
        return view('livewire.admin.report.payment-report');
    }

    protected function getPaymentReport()
    { }
}
