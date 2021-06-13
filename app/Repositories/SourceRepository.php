<?php

namespace App\Repositories;

use App\Models\Admin\Source;
use Illuminate\Support\Facades\Cache;
use App\Contracts\SourceRepositoryInterface;
use App\Http\Requests\SourceRequest;

class SourceRepository implements SourceRepositoryInterface
{
    // Source Index
    public function indexSource()
    {
        $sources = config('coderz.caching', true)
            ? (Cache::has('sources') ? Cache::get('sources') : Cache::rememberForever('sources', function () {
                return Source::latest()->get();
            }))
            : Source::latest()->get();
        return compact('sources');
    }

    // Source Create
    public function createSource()
    {
        //
    }

    // Source Store
    public function storeSource(SourceRequest $request)
    {
        Source::create($request->validated());
    }

    // Source Show
    public function showSource(Source $source)
    {
        return compact('source');
    }

    // Source Edit
    public function editSource(Source $source)
    {
        return compact('source');
    }

    // Source Update
    public function updateSource(SourceRequest $request, Source $source)
    {
        $source->update($request->validated());
    }

    // Source Destroy
    public function destroySource(Source $source)
    {
        $source->delete();
    }
}
