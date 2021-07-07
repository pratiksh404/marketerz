<?php

namespace App\Repositories;

use App\Models\Admin\Department;
use Illuminate\Support\Facades\Cache;
use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Requests\DepartmentRequest;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    // Department Index
    public function indexDepartment()
    {
        $departments = config('coderz.caching', true)
            ? (Cache::has('departments') ? Cache::get('departments') : Cache::rememberForever('departments', function () {
                return Department::latest()->get();
            }))
            : Department::latest()->get();
        return compact('departments');
    }

    // Department Create
    public function createDepartment()
    {
        //
    }

    // Department Store
    public function storeDepartment(DepartmentRequest $request)
    {
        Department::create($request->validated());
    }

    // Department Show
    public function showDepartment(Department $department)
    {
        return compact('department');
    }

    // Department Edit
    public function editDepartment(Department $department)
    {
        return compact('department');
    }

    // Department Update
    public function updateDepartment(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
    }

    // Department Destroy
    public function destroyDepartment(Department $department)
    {
        $department->delete();
    }
}
