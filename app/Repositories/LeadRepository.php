<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Admin\Lead;
use App\Models\Admin\Source;
use App\Models\Admin\Contact;
use App\Models\Admin\Service;
use App\Http\Requests\LeadRequest;
use Illuminate\Support\Facades\Cache;
use App\Contracts\LeadRepositoryInterface;
use App\Models\Admin\Discussion;
use App\Models\Admin\Package;

class LeadRepository implements LeadRepositoryInterface
{
    // Lead Index
    public function indexLead()
    {
        $leads = config('coderz.caching', true)
            ? (Cache::has('leads') ? Cache::get('leads') : Cache::rememberForever('leads', function () {
                return Lead::with('source', 'package', 'contact', 'leadBy', 'assignedTo')->latest()->get();
            }))
            : Lead::with('source', 'package', 'contact', 'leadBy', 'assignedTo')->latest()->get();
        return compact('leads');
    }

    // Lead Create
    public function createLead()
    {
        $users = Cache::get('users', User::latest()->get());
        $sources = Cache::get('sources', Source::latest()->get());
        $packages = Cache::get('packages', Package::latest()->get());
        return compact('users', 'sources', 'packages');
    }

    // Lead Store
    public function storeLead(LeadRequest $request)
    {
        $lead = Lead::create($request->validated());
        $this->leadServices($lead);
    }

    // Lead Show
    public function showLead(Lead $lead)
    {
        $discussions = Discussion::where('lead_id', $lead->id)->latest()->paginate(10);
        return compact('lead', 'discussions');
    }

    // Lead Edit
    public function editLead(Lead $lead)
    {
        $users = Cache::get('users', User::latest()->get());
        $sources = Cache::get('sources', Source::latest()->get());
        $packages = Cache::get('packages', Package::latest()->get());
        return compact('lead', 'users', 'sources', 'packages');
    }

    // Lead Update
    public function updateLead(LeadRequest $request, Lead $lead)
    {
        $lead->update($request->validated());
        $this->leadServices($lead);
    }

    // Lead Destroy
    public function destroyLead(Lead $lead)
    {
        $lead->services()->detach();
        $lead->delete();
    }

    // Lead Discussions
    public function leadDiscussions(Lead $lead)
    {
        $discussions = Discussion::where('lead_id', $lead->id)->latest()->paginate(10);
        return compact('lead', 'discussions');
    }

    // lead Services
    public function leadServices($lead, $sync = false)
    {
        if (request()->services) {
            if ($sync) {
                $lead->services()->sync(request()->services);
            } else {
                $lead->services()->attach(request()->services);
            }
        }
    }
}
