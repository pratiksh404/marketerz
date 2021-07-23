<?php

namespace App\Repositories;

use App\Models\Admin\Lead;
use App\Models\Admin\Discussion;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\DiscussionRequest;
use App\Contracts\DiscussionRepositoryInterface;

class DiscussionRepository implements DiscussionRepositoryInterface
{
    // Discussion Index
    public function indexDiscussion()
    {
        $discussions = config('coderz.caching', true)
            ? (Cache::has('discussions') ? Cache::get('discussions') : Cache::rememberForever('discussions', function () {
                return Discussion::with('lead', 'user')->latest()->get();
            }))
            : Discussion::with('lead', 'user')->latest()->get();
        return compact('discussions');
    }

    // Discussion Create
    public function createDiscussion()
    {
        $leads = Cache::get('leads', Lead::latest()->get());
        return compact('leads');
    }

    // Discussion Store
    public function storeDiscussion(DiscussionRequest $request)
    {
        $discussion = Discussion::create($request->validated());
        $discussion->lead()->update([
            'status' => $discussion->status
        ]);
    }

    // Discussion Show
    public function showDiscussion(Discussion $discussion)
    {
        return compact('discussion');
    }

    // Discussion Edit
    public function editDiscussion(Discussion $discussion)
    {
        $leads = Cache::get('leads', Lead::with('source', 'services', 'contact', 'leadBy', 'assignedTo')->latest()->get());
        return compact('discussion', 'leads');
    }

    // Discussion Update
    public function updateDiscussion(DiscussionRequest $request, Discussion $discussion)
    {
        $discussion->update($request->validated());
        $discussion->lead()->update([
            'status' => $discussion->status
        ]);
    }

    // Discussion Destroy
    public function destroyDiscussion(Discussion $discussion)
    {
        $discussion->delete();
    }
}
