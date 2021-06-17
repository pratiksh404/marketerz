<?php

namespace App\Services;

use App\Models\Admin\Process;

class CampaignProcess
{
    protected $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function store()
    {
        $channel = $this->getChannel();
        $payload = $this->payload;
        if (isset($channel)) {
            Process::create([
                'channel' => $channel,
                'uuid' => $payload['uuid'],
                'status' => 0,
                'payload' => json_encode($payload)
            ]);
        }
    }

    public function getChannel(): int
    {
        $channel = null;
        $payload = $this->payload;
        if (isset($payload)) {
            if (isset($payload['displayName'])) {
                if ($payload['displayName'] == "App\Jobs\EmailNotification") {
                    $channel = 1;
                } else if ($payload['displayName'] == "App\Jobs\SMSNotification") {
                    $channel = 2;
                } else {
                    return $channel = null;
                }
            }
        }
        return $channel;
    }
}
