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

class LeadRepository implements LeadRepositoryInterface
{
    // Lead Index
    public function indexLead()
    {
        $leads = config('coderz.caching', true)
            ? (Cache::has('leads') ? Cache::get('leads') : Cache::rememberForever('leads', function () {
                return Lead::with('source', 'service', 'contact', 'leadBy', 'assignedTo')->latest()->get();
            }))
            : Lead::with('source', 'service', 'contact', 'leadBy', 'assignedTo')->latest()->get();
        return compact('leads');
    }

    // Lead Create
    public function createLead()
    {
        $users = Cache::get('users', User::latest()->get());
        $contacts = Cache::get('contacts', Contact::latest()->get());
        $sources = Cache::get('sources', Source::latest()->get());
        $services = Cache::get('services', Service::with('children')->latest()->get());
        return compact('users', 'contacts', 'sources', 'services');
    }

    // Lead Store
    public function storeLead(LeadRequest $request)
    {
        Lead::create($request->validated());
    }

    // Lead Show
    public function showLead(Lead $lead)
    {
        return compact('lead');
    }

    // Lead Edit
    public function editLead(Lead $lead)
    {
        $users = Cache::get('users', User::latest()->get());
        $contacts = Cache::get('contacts', Contact::latest()->get());
        $sources = Cache::get('sources', Source::latest()->get());
        $services = Cache::get('services', Service::with('children')->latest()->get());
        return compact('lead', 'users', 'contacts', 'sources', 'services');
    }

    // Lead Update
    public function updateLead(LeadRequest $request, Lead $lead)
    {
        $lead->update($request->validated());
    }

    // Lead Destroy
    public function destroyLead(Lead $lead)
    {
        $lead->delete();
    }

    // Lead Discussions
    public function leadDiscussions(Lead $lead)
    {
        $discussions = Discussion::where('lead_id', $lead->id)->latest()->paginate(10);
        return compact('lead', 'discussions');
    }
}
