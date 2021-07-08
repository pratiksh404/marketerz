<?php

namespace App\Contracts;

use App\Models\Admin\Discussion;
use App\Http\Requests\DiscussionRequest;

interface DiscussionRepositoryInterface
{
    public function indexDiscussion();

    public function createDiscussion();

    public function storeDiscussion(DiscussionRequest $request);

    public function showDiscussion(Discussion $Discussion);

    public function editDiscussion(Discussion $Discussion);

    public function updateDiscussion(DiscussionRequest $request, Discussion $Discussion);

    public function destroyDiscussion(Discussion $Discussion);
}
