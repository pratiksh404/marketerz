<?php

namespace App\Events;

use App\Models\Admin\Project;
use Illuminate\Broadcasting\Channel;
use App\Http\Requests\PaymentRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $project;
    public $request;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project, PaymentRequest $request)
    {
        $this->request = $request;
        $this->project = $project;
    }
}
