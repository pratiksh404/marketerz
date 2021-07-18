<?php

namespace App\Events;

use App\Models\Admin\Project;
use App\Http\Requests\ReturnRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReturnEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;

    public $project;

    public $request;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, Project $project, ReturnRequest $request)
    {
        $this->type = $type;
        $this->project = $project;
        $this->request = $request;
    }
}
