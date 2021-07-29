<?php

namespace App\Listeners;

use App\Events\AdvanceEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Pratiksh\Adminetic\Models\Admin\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdvancePaymentAdminNotfication;
use App\Notifications\AdvancePaymentSlackNotfication;

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
                // Dispatching Advance Payment Alert Notfication
                $this->dispatchNotification($advance);
            });
        }
    }

    /**
     *
     * Dispatch Notification
     *
     */
    public function dispatchNotification($advance)
    {
        if (setting('notification', true)) {
            if (setting('advance_payment_notification', true)) {
                $admins = Role::where('name', 'admin')->first()->users;
                $superadmins = Role::where('name', 'superadmin')->first()->users;
                $users = $admins->merge($superadmins);
                Notification::send($users, new AdvancePaymentAdminNotfication($advance));
            }
            if (setting('advance_payment_slack_notification', true)) {
                $users->first()->setSlackUrl(env('ADVANCE_PAYMENT_SLACK_WEBHOOK_URL'))->notify(new AdvancePaymentSlackNotfication($advance));
            }
        }
    }
}
