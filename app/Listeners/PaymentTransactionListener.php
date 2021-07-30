<?php

namespace App\Listeners;

use App\Events\PaymentEvent;
use App\Models\Admin\Payment;
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
        $type = $event->type;
        $project = $event->project;
        $request = $event->request;
        $payment = $event->payment;
        if (isset($project) && isset($request)) {
            DB::transaction(function () use ($type, $project, $request, $payment) {
                if ($type == 1) {
                    $payment = $project->payments()->create($request->validated());
                    $payment->update([
                        'client_id' => $payment->project->client_id ?? null
                    ]);
                } elseif ($type = 2) {
                    $payment->update($request->validated());
                    $payment->update([
                        'client_id' => $payment->project->client_id ?? null
                    ]);
                }
                $this->updateProject($project);
                $this->handleClientAccount($project, $payment);
            });
        }
    }

    protected function updateProject($project)
    {
        $project->update([
            'paid_amount' => Payment::where('project_id', $project->id)->sum('payment')
        ]);
    }

    protected function handleClientAccount($project, $payment)
    {
        $client = $project->client;
        if (isset($client)) {
            $payment = $client->payments->sum('payment') ?? 0;
            $advance = $client->advances->sum('amount') ?? 0;

            $client->update([
                'credit' => ($payment - $advance) > 0 ? ($payment - $advance) : 0,
                'debit' => ($advance - $payment) >= 0 ? ($advance - $payment) : 0,
            ]);
        }
    }
}
