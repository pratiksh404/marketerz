<?php

namespace App\Listeners;

use App\Events\ReturnEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReturnTransactionListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ReturnEvent $event)
    {
        $type = $event->type;
        $project = $event->project;
        $request = $event->request;

        if (isset($project) && isset($request)) {
            DB::transaction(function () use ($type, $project, $request) {
                if ($type == 1) {
                    $project->update([
                        'cancel' => $request->cancel,
                        'cancel_date' => $request->cancel_date,
                        'return' => $request->return,
                        'return_remark' => $request->return_remark,
                        'paid_amount' => $project->paid_amount - $request->return
                    ]);
                }
                $this->handleClientAccount($project);
            });
        }
    }

    protected function handleClientAccount($project)
    {
        $client = $project->client;
        if (isset($client) && isset($project)) {
            $client->update([
                'credit' => $client->credit + $project->return,
                'debit' => $client->debit - $project->return
            ]);
        }
    }
}
