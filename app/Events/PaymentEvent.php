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

    public $type;
    public $project;
    public $request;
    public $payment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, Project $project, PaymentRequest $request, $payment = null)
    {
        $this->type = $type;
        $this->project = $project;
        $this->request = $request;
        $this->payment = $payment;
    }
}
