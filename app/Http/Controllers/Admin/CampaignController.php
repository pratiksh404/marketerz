<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Campaign;
use Illuminate\Http\Request;
use App\Http\Requests\CampaignRequest;
use App\Http\Controllers\Controller;
use App\Contracts\CampaignRepositoryInterface;

class CampaignController extends Controller
{
    protected $campaignRepositoryInterface;

    public function __construct(CampaignRepositoryInterface $campaignRepositoryInterface)
    {
        $this->campaignRepositoryInterface = $campaignRepositoryInterface;
        $this->authorizeResource(Campaign::class, 'campaign');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.campaign.index', $this->campaignRepositoryInterface->indexCampaign());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CampaignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $this->campaignRepositoryInterface->storeCampaign($request);
        return redirect(adminRedirectRoute('campaign'))->withSuccess('Campaign Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('admin.campaign.show', $this->campaignRepositoryInterface->showCampaign($campaign));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaign.edit', $this->campaignRepositoryInterface->editCampaign($campaign));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CampaignRequest  $request
     * @param  \App\Models\Admin\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $this->campaignRepositoryInterface->updateCampaign($request, $campaign);
        return redirect(adminRedirectRoute('campaign'))->withInfo('Campaign Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $this->campaignRepositoryInterface->destroyCampaign($campaign);
        return redirect(adminRedirectRoute('campaign'))->withFail('Campaign Deleted Successfully.');
    }
}
