<?php

namespace App\Repositories;

use App\Models\Admin\Package;
use App\Models\Admin\Service;
use App\Models\Admin\Department;
use App\Http\Requests\PackageRequest;
use Illuminate\Support\Facades\Cache;
use App\Contracts\PackageRepositoryInterface;

class PackageRepository implements PackageRepositoryInterface
{
    // Package Index
    public function indexPackage()
    {
        $packages = config('coderz.caching', true)
            ? (Cache::has('packages') ? Cache::get('packages') : Cache::rememberForever('packages', function () {
                return Package::latest()->get();
            }))
            : Package::latest()->get();
        return compact('packages');
    }

    // Package Create
    public function createPackage()
    {
        $departments = Cache::get('departments', Department::latest()->get());
        $services = Cache::get('services', Service::latest()->get());
        return compact('departments', 'services');
    }

    // Package Store
    public function storePackage(PackageRequest $request)
    {
        $package = Package::create($request->validated());
        $this->packageServices($package, true);
    }

    // Package Show
    public function showPackage(Package $package)
    {
        return compact('package');
    }

    // Package Edit
    public function editPackage(Package $package)
    {
        $departments = Cache::get('departments', Department::latest()->get());
        $services = Cache::get('services', Service::latest()->get());
        return compact('package', 'departments', 'services');
    }

    // Package Update
    public function updatePackage(PackageRequest $request, Package $package)
    {
        $package->update($request->validated());
        $this->packageServices($package);
    }

    // Package Destroy
    public function destroyPackage(Package $package)
    {
        $package->services()->detach();
        $package->delete();
    }

    // Package Services
    public function packageServices($package, $sync = false)
    {
        if (request()->services) {
            if ($sync) {
                $package->services()->sync(request()->services);
            } else {
                $package->services()->attach(request()->services);
            }
        }
    }
}
