<?php

namespace App\Listeners;

use App\Events\AdvanceEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvanceTransactionListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AdvanceEvent $event)
    {
        $type = $event->type;
        $client = $event->client;
        $request = $event->request;
        $advance = $event->advance;
        $old_advance_amount = $event->old_advance_amount;
        if (isset($client) && isset($request)) {
            DB::transaction(function () use ($type, $client, $request, $advance, $old_advance_amount) {
                if ($type == 1) {
                    $advance = $client->advances()->create($request->validated());
                    $client->update([
                        'credit' => $client->credit + $advance->amount
                    ]);
                } elseif ($type = 2) {
                    $advance->update($request->validated());
                    if (isset($old_advance_amount)) {
                        $client->update([
                            'credit' => ($client->credit - $old_advance_amount) + $advance->amount
                        ]);
                    }
                }
            });
        }
    }
}
