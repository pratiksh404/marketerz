<?php

namespace App\Repositories;

use App\Models\Admin\Service;
use Illuminate\Support\Facades\Cache;
use App\Contracts\ServiceRepositoryInterface;
use App\Http\Requests\ServiceRequest;

class ServiceRepository implements ServiceRepositoryInterface
{
    // Service Index
    public function indexService()
    {
        $services = config('coderz.caching', true)
            ? (Cache::has('services') ? Cache::get('services') : Cache::rememberForever('services', function () {
                return Service::latest()->get();
            }))
            : Service::latest()->get();
        return compact('services');
    }

    // Service Create
    public function createService()
    {
        $services = Cache::get('services', Service::all());
        return compact('services');
    }

    // Service Store
    public function storeService(ServiceRequest $request)
    {
        Service::create($request->validated());
    }

    // Service Show
    public function showService(Service $service)
    {
        return compact('service');
    }

    // Service Edit
    public function editService(Service $service)
    {
        $services = Cache::get('services', Service::all());
        return compact('service', 'services');
    }

    // Service Update
    public function updateService(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
    }

    // Service Destroy
    public function destroyService(Service $service)
    {
        $service->delete();
    }
}
