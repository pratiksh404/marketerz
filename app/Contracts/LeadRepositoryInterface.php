<?php

namespace App\Contracts;

use App\Models\Admin\Lead;
use App\Http\Requests\LeadRequest;

interface LeadRepositoryInterface
{
    public function indexLead();

    public function createLead();

    public function storeLead(LeadRequest $request);

    public function showLead(Lead $Lead);

    public function editLead(Lead $Lead);

    public function updateLead(LeadRequest $request, Lead $Lead);

    public function destroyLead(Lead $Lead);

    public function leadDiscussions(Lead $lead);
}
