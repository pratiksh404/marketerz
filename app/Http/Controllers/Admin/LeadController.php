<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Lead;
use Illuminate\Http\Request;
use App\Http\Requests\LeadRequest;
use App\Http\Controllers\Controller;
use App\Contracts\LeadRepositoryInterface;
use App\Http\Requests\DiscussionRequest;
use App\Models\Admin\Discussion;

class LeadController extends Controller
{
    protected $leadRepositoryInterface;

    public function __construct(LeadRepositoryInterface $leadRepositoryInterface)
    {
        $this->leadRepositoryInterface = $leadRepositoryInterface;
        $this->authorizeResource(Lead::class, 'lead');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lead.index', $this->leadRepositoryInterface->indexLead());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lead.create', $this->leadRepositoryInterface->createLead());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadRequest $request)
    {
        $this->leadRepositoryInterface->storeLead($request);
        return redirect(adminRedirectRoute('lead'))->withSuccess('Lead Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        return view('admin.lead.show', $this->leadRepositoryInterface->showLead($lead));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        return view('admin.lead.edit', $this->leadRepositoryInterface->editLead($lead));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LeadRequest  $request
     * @param  \App\Models\Admin\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(LeadRequest $request, Lead $lead)
    {
        $this->leadRepositoryInterface->updateLead($request, $lead);
        return redirect(adminRedirectRoute('lead'))->withInfo('Lead Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $this->leadRepositoryInterface->destroyLead($lead);
        return redirect(adminRedirectRoute('lead'))->withFail('Lead Deleted Successfully.');
    }

    /**
     *
     * Lead Discussions
     *
     */
    public function lead_discussions(Lead $lead)
    {
        return view('admin.lead.discussions', $this->leadRepositoryInterface->leadDiscussions($lead));
    }

    /**
     *
     * Store Lead Discussion
     *
     */
    public function store_lead_discussion(DiscussionRequest $request)
    {
        $discussion = Discussion::create($request->validated());
        $discussion->lead()->update([
            'status' => $discussion->status
        ]);
        return redirect(route('lead_discussions', ['lead' => $discussion->lead_id]))->withSuccess('Lead Discussion Created Successfully.');
    }
}
