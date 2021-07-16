<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Marketerz;
use App\Models\Admin\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Contracts\PaymentRepositoryInterface;

class PaymentController extends Controller
{
    protected $paymentRepositoryInterface;

    public function __construct(PaymentRepositoryInterface $paymentRepositoryInterface)
    {
        $this->paymentRepositoryInterface = $paymentRepositoryInterface;
        $this->authorizeResource(Payment::class, 'payment');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.payment.index', $this->paymentRepositoryInterface->indexPayment());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $this->paymentRepositoryInterface->storePayment($request);
        return redirect(adminRedirectRoute('payment'))->withSuccess('Payment Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('admin.payment.show', $this->paymentRepositoryInterface->showPayment($payment));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('admin.payment.edit', $this->paymentRepositoryInterface->editPayment($payment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PaymentRequest  $request
     * @param  \App\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        $this->paymentRepositoryInterface->updatePayment($request, $payment);
        return redirect(adminRedirectRoute('payment'))->withInfo('Payment Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $this->paymentRepositoryInterface->destroyPayment($payment);
        return redirect(adminRedirectRoute('payment'))->withFail('Payment Deleted Successfully.');
    }
}
