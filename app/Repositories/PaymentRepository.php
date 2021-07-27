<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Events\PaymentEvent;
use App\Models\Admin\Payment;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Cache;
use App\Contracts\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    // Payment Index
    public function indexPayment()
    {
        $payments = config('coderz.caching', true)
            ? (Cache::has('payments') ? Cache::get('payments') : Cache::rememberForever('payments', function () {
                return Payment::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->latest()->get();
            }))
            : Payment::with('client', 'lead', 'package', 'department', 'projectHead', 'services', 'user', 'payments')->latest()->get();

        $total_payments = Payment::sum('payment');
        $today_total_payments = Payment::whereDate('updated_at', Carbon::now())->sum('payment');
        $week_total_payments = Payment::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('payment');
        $month_total_payment = Payment::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('payment');
        $year_total_payment = Payment::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('payment');
        return compact('payments', 'total_payments', 'today_total_payments', 'week_total_payments', 'month_total_payment', 'year_total_payment');
    }

    // Payment Create
    public function createPayment()
    {
        //
    }

    // Payment Store
    public function storePayment(PaymentRequest $request)
    {
        Payment::create($request->validated());
    }

    // Payment Show
    public function showPayment(Payment $payment)
    {
        return compact('payment');
    }

    // Payment Edit
    public function editPayment(Payment $payment)
    {
        return compact('payment');
    }

    // Payment Update
    public function updatePayment(PaymentRequest $request, Payment $payment)
    {
        event(new PaymentEvent(2, $payment->project, $request, $payment));
    }

    // Payment Destroy
    public function destroyPayment(Payment $payment)
    {
        $project = $payment->project;
        $payment->delete();
        $project->update([
            'paid_amount' => Payment::where('project_id', $project->id)->sum('payment')
        ]);
    }
}
