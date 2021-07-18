<?php

namespace App\Events;

use App\Models\Admin\Project;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectInitializedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $project;

    public $type;

    public $old_lead;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, Project $project, $old_lead = null)
    {
        $this->project = $project;
        $this->type = $type;
        $this->old_lead = $old_lead;
    }
}
