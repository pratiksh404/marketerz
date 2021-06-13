<?php

namespace App\Repositories;

use App\Models\Admin\Group;
use Illuminate\Support\Facades\Cache;
use App\Contracts\GroupRepositoryInterface;
use App\Http\Requests\GroupRequest;

class GroupRepository implements GroupRepositoryInterface
{
    // Group Index
    public function indexGroup()
    {
        $groups = config('coderz.caching', true)
            ? (Cache::has('groups') ? Cache::get('groups') : Cache::rememberForever('groups', function () {
                return Group::latest()->get();
            }))
            : Group::latest()->get();
        return compact('groups');
    }

    // Group Create
    public function createGroup()
    {
        //
    }

    // Group Store
    public function storeGroup(GroupRequest $request)
    {
        Group::create($request->validated());
    }

    // Group Show
    public function showGroup(Group $group)
    {
        return compact('group');
    }

    // Group Edit
    public function editGroup(Group $group)
    {
        return compact('group');
    }

    // Group Update
    public function updateGroup(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());
    }

    // Group Destroy
    public function destroyGroup(Group $group)
    {
        $group->delete();
    }
}
