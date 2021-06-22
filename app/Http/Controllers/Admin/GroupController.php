<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Group;
use Illuminate\Http\Request;
use App\Imports\GroupContact;
use App\Http\Requests\GroupRequest;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\GroupRepositoryInterface;

class GroupController extends Controller
{
    protected $groupRepositoryInterface;

    public function __construct(GroupRepositoryInterface $groupRepositoryInterface)
    {
        $this->groupRepositoryInterface = $groupRepositoryInterface;
        $this->authorizeResource(Group::class, 'group');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.group.index', $this->groupRepositoryInterface->indexGroup());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $this->groupRepositoryInterface->storeGroup($request);
        return redirect(adminRedirectRoute('group'))->withSuccess('Group Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('admin.group.show', $this->groupRepositoryInterface->showGroup($group));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('admin.group.edit', $this->groupRepositoryInterface->editGroup($group));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GroupRequest  $request
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        $this->groupRepositoryInterface->updateGroup($request, $group);
        return redirect(adminRedirectRoute('group'))->withInfo('Group Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $this->groupRepositoryInterface->destroyGroup($group);
        return redirect(adminRedirectRoute('group'))->withFail('Group Deleted Successfully.');
    }

    /**
     *
     * Import Contacts
     *
     */
    public function import(Group $group)
    {
        Excel::import(new GroupContact($group), request()->file('contacts_import'));
        return redirect(adminRedirectRoute('group'))->withSuccess('Contacts Imported.');
    }
}
