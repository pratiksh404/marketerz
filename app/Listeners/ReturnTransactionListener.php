<?php

namespace App\Listeners;

use App\Events\ReturnEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Pratiksh\Adminetic\Models\Admin\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReturnAdminNotfication;
use App\Notifications\ReturnAdminSlackNotfication;

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
                $this->dispatchNotification($project);
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

    protected function dispatchNotification($project)
    {
        if (setting('notification', true)) {
            if (setting('project_cancellation_notification', true)) {
                $admins = Role::where('name', 'admin')->first()->users;
                $superadmins = Role::where('name', 'superadmin')->first()->users;
                $users = $admins->merge($superadmins);
                Notification::send($users, new ReturnAdminNotfication($project));
            }
            if (setting('project_cancellation_slack_notification', true)) {
                $users->first()->setSlackUrl(env('PROJECT_CANCELLATION_SLACK_WEBHOOK_URL'))->notify(new ReturnAdminSlackNotfication($project));
            }
        }
    }
}
