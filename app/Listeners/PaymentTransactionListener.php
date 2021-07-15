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
                    $project->payments()->create($request->validated());
                    $this->updateProject($project);
                } elseif ($type = 2) {
                    $payment->update($request->validated());
                    $this->updateProject($project);
                }
            });
        }
    }

    protected function updateProject($project)
    {
        $project->update([
            'paid_amount' => Payment::where('project_id', $project->id)->sum('payment')
        ]);
    }
}
