<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Source;
use Illuminate\Http\Request;
use App\Http\Requests\SourceRequest;
use App\Http\Controllers\Controller;
use App\Contracts\SourceRepositoryInterface;

class SourceController extends Controller
{
    protected $sourceRepositoryInterface;

    public function __construct(SourceRepositoryInterface $sourceRepositoryInterface)
    {
        $this->sourceRepositoryInterface = $sourceRepositoryInterface;
        $this->authorizeResource(Source::class, 'source');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.source.index', $this->sourceRepositoryInterface->indexSource());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.source.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SourceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SourceRequest $request)
    {
        $this->sourceRepositoryInterface->storeSource($request);
        return redirect(adminRedirectRoute('source'))->withSuccess('Source Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        return view('admin.source.show', $this->sourceRepositoryInterface->showSource($source));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('admin.source.edit', $this->sourceRepositoryInterface->editSource($source));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SourceRequest  $request
     * @param  \App\Models\Admin\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(SourceRequest $request, Source $source)
    {
        $this->sourceRepositoryInterface->updateSource($request, $source);
        return redirect(adminRedirectRoute('source'))->withInfo('Source Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        $this->sourceRepositoryInterface->destroySource($source);
        return redirect(adminRedirectRoute('source'))->withFail('Source Deleted Successfully.');
    }
}
