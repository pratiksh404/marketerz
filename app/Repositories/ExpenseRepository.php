<?php

namespace App\Repositories;

use App\Models\Admin\Expense;
use Illuminate\Support\Facades\Cache;
use App\Contracts\ExpenseRepositoryInterface;
use App\Http\Requests\ExpenseRequest;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    // Expense Index
    public function indexExpense()
    {
        $expenses = config('coderz.caching', true)
            ? (Cache::has('expenses') ? Cache::get('expenses') : Cache::rememberForever('expenses', function () {
                return Expense::with('user')->latest()->get();
            }))
            : Expense::with('user')->latest()->get();
        return compact('expenses');
    }

    // Expense Create
    public function createExpense()
    {
        //
    }

    // Expense Store
    public function storeExpense(ExpenseRequest $request)
    {
        Expense::create($request->validated());
    }

    // Expense Show
    public function showExpense(Expense $expense)
    {
        return compact('expense');
    }

    // Expense Edit
    public function editExpense(Expense $expense)
    {
        return compact('expense');
    }

    // Expense Update
    public function updateExpense(ExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->validated());
    }

    // Expense Destroy
    public function destroyExpense(Expense $expense)
    {
        $expense->delete();
    }
}
