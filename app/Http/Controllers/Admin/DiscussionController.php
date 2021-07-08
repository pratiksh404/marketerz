<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Discussion;
use Illuminate\Http\Request;
use App\Http\Requests\DiscussionRequest;
use App\Http\Controllers\Controller;
use App\Contracts\DiscussionRepositoryInterface;

class DiscussionController extends Controller
{
    protected $discussionRepositoryInterface;

    public function __construct(DiscussionRepositoryInterface $discussionRepositoryInterface)
    {
        $this->discussionRepositoryInterface = $discussionRepositoryInterface;
        $this->authorizeResource(Discussion::class, 'discussion');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.discussion.index', $this->discussionRepositoryInterface->indexDiscussion());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discussion.create', $this->discussionRepositoryInterface->createDiscussion());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DiscussionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionRequest $request)
    {
        $this->discussionRepositoryInterface->storeDiscussion($request);
        return redirect(adminRedirectRoute('discussion'))->withSuccess('Discussion Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('admin.discussion.show', $this->discussionRepositoryInterface->showDiscussion($discussion));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        return view('admin.discussion.edit', $this->discussionRepositoryInterface->editDiscussion($discussion));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DiscussionRequest  $request
     * @param  \App\Models\Admin\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(DiscussionRequest $request, Discussion $discussion)
    {
        $this->discussionRepositoryInterface->updateDiscussion($request, $discussion);
        return redirect(adminRedirectRoute('discussion'))->withInfo('Discussion Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $this->discussionRepositoryInterface->destroyDiscussion($discussion);
        return redirect(adminRedirectRoute('discussion'))->withFail('Discussion Deleted Successfully.');
    }
}
