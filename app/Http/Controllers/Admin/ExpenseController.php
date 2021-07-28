<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;
use App\Http\Controllers\Controller;
use App\Contracts\ExpenseRepositoryInterface;

class ExpenseController extends Controller
{
    protected $expenseRepositoryInterface;

    public function __construct(ExpenseRepositoryInterface $expenseRepositoryInterface)
    {
        $this->expenseRepositoryInterface = $expenseRepositoryInterface;
        $this->authorizeResource(Expense::class, 'expense');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expense.index', $this->expenseRepositoryInterface->indexExpense());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $this->expenseRepositoryInterface->storeExpense($request);
        return redirect(adminRedirectRoute('expense'))->withSuccess('Expense Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('admin.expense.show', $this->expenseRepositoryInterface->showExpense($expense));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('admin.expense.edit', $this->expenseRepositoryInterface->editExpense($expense));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ExpenseRequest  $request
     * @param  \App\Models\Admin\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->expenseRepositoryInterface->updateExpense($request, $expense);
        return redirect(adminRedirectRoute('expense'))->withInfo('Expense Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $this->expenseRepositoryInterface->destroyExpense($expense);
        return redirect(adminRedirectRoute('expense'))->withFail('Expense Deleted Successfully.');
    }
}
