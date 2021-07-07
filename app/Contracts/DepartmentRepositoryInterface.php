<?php

namespace App\Contracts;

use App\Models\Admin\Department;
use App\Http\Requests\DepartmentRequest;

interface DepartmentRepositoryInterface
{
    public function indexDepartment();

    public function createDepartment();

    public function storeDepartment(DepartmentRequest $request);

    public function showDepartment(Department $Department);

    public function editDepartment(Department $Department);

    public function updateDepartment(DepartmentRequest $request, Department $Department);

    public function destroyDepartment(Department $Department);
}
