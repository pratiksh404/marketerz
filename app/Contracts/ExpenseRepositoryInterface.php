<?php

namespace App\Contracts;

use App\Models\Admin\Expense;
use App\Http\Requests\ExpenseRequest;

interface ExpenseRepositoryInterface
{
    public function indexExpense();

    public function createExpense();

    public function storeExpense(ExpenseRequest $request);

    public function showExpense(Expense $Expense);

    public function editExpense(Expense $Expense);

    public function updateExpense(ExpenseRequest $request, Expense $Expense);

    public function destroyExpense(Expense $Expense);
}
