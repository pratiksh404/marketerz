<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Advance;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceRequest;
use App\Http\Controllers\Controller;
use App\Contracts\AdvanceRepositoryInterface;

class AdvanceController extends Controller
{
    protected $advanceRepositoryInterface;

    public function __construct(AdvanceRepositoryInterface $advanceRepositoryInterface)
    {
        $this->advanceRepositoryInterface = $advanceRepositoryInterface;
        $this->authorizeResource(Advance::class, 'advance');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.advance.index', $this->advanceRepositoryInterface->indexAdvance());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advance.create', $this->advanceRepositoryInterface->createAdvance());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdvanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvanceRequest $request)
    {
        $this->advanceRepositoryInterface->storeAdvance($request);
        return redirect(adminRedirectRoute('advance'))->withSuccess('Advance Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        return view('admin.advance.show', $this->advanceRepositoryInterface->showAdvance($advance));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(Advance $advance)
    {
        return view('admin.advance.edit', $this->advanceRepositoryInterface->editAdvance($advance));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdvanceRequest  $request
     * @param  \App\Models\Admin\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(AdvanceRequest $request, Advance $advance)
    {
        $this->advanceRepositoryInterface->updateAdvance($request, $advance);
        return redirect(adminRedirectRoute('advance'))->withInfo('Advance Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        $this->advanceRepositoryInterface->destroyAdvance($advance);
        return redirect(adminRedirectRoute('advance'))->withFail('Advance Deleted Successfully.');
    }
}
