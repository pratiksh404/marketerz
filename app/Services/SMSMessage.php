<?php

namespace App\Services;

use Carbon\Carbon;

class SMSMessage
{
    protected $baseUrl;
    protected $token;
    protected $to;
    protected $from;
    protected $message;
    protected $dryrun = false;

    /**
     * SmsMessage constructor.
     * @param array $lines
     */
    public function __construct($lines = [])
    {
        // Pull in config from the config/services.php file.
        $this->baseUrl = config('adminetic.sms.base_url');
        $this->from = config('adminetic.sms.from');
        $this->token = config('adminetic.sms.token');
    }

    public function to($to): self
    {
        $this->to = $to;

        return $this;
    }

    public function from($from): self
    {
        $this->from = $from;

        return $this;
    }

    public function send(): void
    {
        if (!$this->from || !$this->to || !count($this->message)) {
            throw new \Exception('SMS not correct.');
        }

        $args = http_build_query(array(
            'token' => $this->token,
            'from'  => $this->from,
            'to'    => $this->to,
            'text'  => $this->message
        ));

        $url = $this->baseUrl;

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        app('log')->info(json_encode([
            'response' => $response,
            'status_info' => $status_code,
            'data' => json_encode([
                'from' => $this->from,
                'to' => $this->to,
                'message' => $this->message,
                'date_time' => Carbon::now()->toDateTimeString()
            ], true),
        ]));

        curl_close($ch);
    }

    public function dryrun($dry = true): self
    {
        $this->dryrun = $dry;

        return $this;
    }
}
