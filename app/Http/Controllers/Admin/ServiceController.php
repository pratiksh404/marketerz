<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Http\Controllers\Controller;
use App\Contracts\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    protected $serviceRepositoryInterface;

    public function __construct(ServiceRepositoryInterface $serviceRepositoryInterface)
    {
        $this->serviceRepositoryInterface = $serviceRepositoryInterface;
        $this->authorizeResource(Service::class, 'service');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.service.index', $this->serviceRepositoryInterface->indexService());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create', $this->serviceRepositoryInterface->createService());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequestt  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $this->serviceRepositoryInterface->storeService($request);
        return redirect(adminRedirectRoute('service'))->withSuccess('Service Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.service.show', $this->serviceRepositoryInterface->showService($service));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.service.edit', $this->serviceRepositoryInterface->editService($service));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $this->serviceRepositoryInterface->updateService($request, $service);
        return redirect(adminRedirectRoute('service'))->withInfo('Service Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->serviceRepositoryInterface->destroyService($service);
        return redirect(adminRedirectRoute('service'))->withFail('Service Deleted Successfully.');
    }
}
