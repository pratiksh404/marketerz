<?php

namespace App\Repositories;

use App\Models\Admin\Campaign;
use Illuminate\Support\Facades\Cache;
use App\Contracts\CampaignRepositoryInterface;
use App\Facades\Marketerz;
use App\Http\Requests\CampaignRequest;

class CampaignRepository implements CampaignRepositoryInterface
{
    // Campaign Index
    public function indexCampaign()
    {
        $campaigns = config('coderz.caching', true)
            ? (Cache::has('campaigns') ? Cache::get('campaigns') : Cache::rememberForever('campaigns', function () {
                return Campaign::latest()->get();
            }))
            : Campaign::latest()->get();
        return compact('campaigns');
    }

    // Campaign Create
    public function createCampaign()
    {
        //
    }

    // Campaign Store
    public function storeCampaign(CampaignRequest $request)
    {
        Campaign::create($request->validated());
    }

    // Campaign Show
    public function showCampaign(Campaign $campaign)
    {
        return compact('campaign');
    }

    // Campaign Edit
    public function editCampaign(Campaign $campaign)
    {
        return compact('campaign');
    }

    // Campaign Update
    public function updateCampaign(CampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->validated());
    }

    // Campaign Destroy
    public function destroyCampaign(Campaign $campaign)
    {
        $campaign->delete();
    }
}
