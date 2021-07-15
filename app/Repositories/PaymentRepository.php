<?php

namespace App\Repositories;

use App\Models\Admin\Payment;
use Illuminate\Support\Facades\Cache;
use App\Contracts\PaymentRepositoryInterface;
use App\Http\Requests\PaymentRequest;

class PaymentRepository implements PaymentRepositoryInterface
{
    // Payment Index
    public function indexPayment()
    {
        $payments = config('coderz.caching', true)
            ? (Cache::has('payments') ? Cache::get('payments') : Cache::rememberForever('payments', function () {
                return Payment::latest()->get();
            }))
            : Payment::latest()->get();
        return compact('payments');
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
        $payment->update($request->validated());
    }

    // Payment Destroy
    public function destroyPayment(Payment $payment)
    {
        $payment->delete();
    }
}
