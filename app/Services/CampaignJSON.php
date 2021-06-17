<?php

namespace App\Services;

use Response;
use File;


class CampaignJSON
{
    protected $job;

    protected $status;

    public function __construct($job, $status = false)
    {
        $this->job  = $job;
        $this->status = $status;
    }


    public function storeToJSONCampaign()
    {
        $allJSONData = is_array($this->getCampaignJSON()) ? $this->getCampaignJSON() : array();
        $campaignData = is_array($this->campaignData()) ? $this->campaignData() : array();
        $data = array_merge($allJSONData, $campaignData);

        $jsongFile = 'campaign_file.json';

        if (!file_exists($path = public_path('/upload/json/campaign'))) {
            mkdir($path, 0777, true);
        }

        File::put($this->campaignJSONPath($jsongFile), json_encode($data));
    }

    public function downloadJSONCampaign()
    {
        $jsongFile = 'campaign_file.json';
        return Response::download($this->campaignJSONPath($jsongFile));
    }

    public function getCampaignJSON()
    {
        $file = $this->campaignJSONPath('campaign_file.json');
        return file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    }

    /**
     *
     * Campaign JSON Path
     *
     *@return string
     *
     */
    private function campaignJSONPath($filename): string
    {
        return public_path('/upload/json/campaign/' . $filename);
    }

    /**
     *
     * Campaign Data
     *
     *@return array
     *
     */
    private function campaignData(): array
    {
        $data = array();
        $data['uuid'] = $this->job->uuid();
        $data['payload'] = $this->job->payload();
        $data['status'] = $this->status;
        return $data;
    }
}
