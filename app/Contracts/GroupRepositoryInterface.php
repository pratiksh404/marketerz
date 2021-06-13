<?php

namespace App\Contracts;

use App\Models\Admin\Group;
use App\Http\Requests\GroupRequest;

interface GroupRepositoryInterface
{
    public function indexGroup();

    public function createGroup();

    public function storeGroup(GroupRequest $request);

    public function showGroup(Group $Group);

    public function editGroup(Group $Group);

    public function updateGroup(GroupRequest $request, Group $Group);

    public function destroyGroup(Group $Group);
}
