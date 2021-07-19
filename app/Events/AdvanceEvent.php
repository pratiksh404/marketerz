<?php

namespace App\Events;

use App\Http\Requests\AdvanceRequest;
use App\Models\Admin\Client;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdvanceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;

    public $client;

    public $request;

    public $advance;

    public $old_advance_amount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, Client $client, AdvanceRequest $request, $advance = 0, $old_advance_amount = null)
    {
        $this->type = $type;
        $this->client = $client;
        $this->request = $request;
        $this->advance = $advance;
        $this->old_advance_amount = $old_advance_amount;
    }
}
