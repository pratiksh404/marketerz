<?php

namespace App\Contracts;

use App\Models\Admin\Campaign;
use App\Http\Requests\CampaignRequest;

interface CampaignRepositoryInterface
{
    public function indexCampaign();

    public function createCampaign();

    public function storeCampaign(CampaignRequest $request);

    public function showCampaign(Campaign $Campaign);

    public function editCampaign(Campaign $Campaign);

    public function updateCampaign(CampaignRequest $request, Campaign $Campaign);

    public function destroyCampaign(Campaign $Campaign);
}
