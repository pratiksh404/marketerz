<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Http\Controllers\Controller;
use App\Contracts\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{
    protected $departmentRepositoryInterface;

    public function __construct(DepartmentRepositoryInterface $departmentRepositoryInterface)
    {
        $this->departmentRepositoryInterface = $departmentRepositoryInterface;
        $this->authorizeResource(Department::class, 'department');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.department.index', $this->departmentRepositoryInterface->indexDepartment());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $this->departmentRepositoryInterface->storeDepartment($request);
        return redirect(adminRedirectRoute('department'))->withSuccess('Department Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('admin.department.show', $this->departmentRepositoryInterface->showDepartment($department));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('admin.department.edit', $this->departmentRepositoryInterface->editDepartment($department));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentRequest  $request
     * @param  \App\Models\Admin\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $this->departmentRepositoryInterface->updateDepartment($request, $department);
        return redirect(adminRedirectRoute('department'))->withInfo('Department Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->departmentRepositoryInterface->destroyDepartment($department);
        return redirect(adminRedirectRoute('department'))->withFail('Department Deleted Successfully.');
    }
}
