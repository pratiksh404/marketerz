<?php

namespace App\Listeners;

use App\Events\PaymentEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentTransactionListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PaymentEvent $event)
    {
        $project = $event->project;
        $request = $event->request;
        if (isset($project) && isset($request)) {
            DB::transaction(function () use ($project, $request) {
                $payment = $project->payments()->create($request->validated());
                $project->update([
                    'paid_amount' => $project->paid_amount + $payment->payment
                ]);
            });
        }
    }
}
