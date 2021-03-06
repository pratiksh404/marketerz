<?php

namespace App\Repositories;

use App\Facades\Marketerz;
use App\Models\Admin\Contact;
use App\Models\Admin\Campaign;
use App\Events\CampaignCreatedEvent;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\CampaignRequest;
use App\Contracts\CampaignRepositoryInterface;


class CampaignRepository implements CampaignRepositoryInterface
{
    // Campaign Index
    public function indexCampaign()
    {
        $file = public_path('/upload/json/campaign/campaign_file.json');
        $data = json_decode(file_get_contents($file), true);
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
        $campaign = Campaign::create($request->validated());
        CampaignCreatedEvent::dispatch($campaign);
    }

    // Campaign Show
    public function showCampaign(Campaign $campaign)
    {
        $contacts = Contact::find($campaign->contacts);
        return compact('campaign', 'contacts');
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
