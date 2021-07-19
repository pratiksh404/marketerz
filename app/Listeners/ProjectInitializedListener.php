<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\ProjectInitializedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectInitializedListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProjectInitializedEvent $event)
    {
        $type = $event->type;
        $project = $event->project;
        $old_lead = $event->old_lead;
        if (isset($type) && isset($project)) {
            $this->handleLead($type, $project, $old_lead);
        }
    }

    protected function handleLead($type, $project, $old_lead)
    {
        if (isset($project->lead)) {
            if ($type == 1) {
                $project->lead()->update([
                    'converted_to_client' => 1,
                    'status' => 6,
                    'converted_to_client_date' => Carbon::now()
                ]);
            } elseif ($type == 2) {
                if (isset($old_lead)) {
                    if ($old_lead != $project->lead_id) {
                        $oldlead = Lead::find($old_lead);
                        if (isset($oldlead)) {
                            $oldlead->update([
                                'converted_to_client' => 0,
                                'status' => 4
                            ]);
                        }
                        $project->lead()->update([
                            'converted_to_client' => 1,
                            'status' => 6,
                            'converted_to_client_date' => Carbon::now()
                        ]);
                    }
                }
            }
        }
    }
}
