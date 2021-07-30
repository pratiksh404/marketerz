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
        if (isset($client) && isset($request)) {
            DB::transaction(function () use ($type, $client, $request, $advance) {
                if ($type == 1) {
                    $advance = $client->advances()->create($request->validated());
                } elseif ($type = 2) {
                    $advance->update($request->validated());
                }
                // Dispatching Advance Payment Alert Notfication
                $this->handleClientAccount($client, $advance);
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

    /**
     *
     * Dispatch Client Account
     *
     */
    protected function handleClientAccount($client, $advance)
    {
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
