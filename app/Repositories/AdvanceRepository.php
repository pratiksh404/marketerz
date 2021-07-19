<?php

namespace App\Repositories;

use App\Models\Admin\Client;
use App\Models\Admin\Advance;
use App\Http\Requests\AdvanceRequest;
use Illuminate\Support\Facades\Cache;
use App\Contracts\AdvanceRepositoryInterface;

class AdvanceRepository implements AdvanceRepositoryInterface
{
    // Advance Index
    public function indexAdvance()
    {
        $advances = config('coderz.caching', true)
            ? (Cache::has('advances') ? Cache::get('advances') : Cache::rememberForever('advances', function () {
                return Advance::latest()->get();
            }))
            : Advance::latest()->get();
        return compact('advances');
    }

    // Advance Create
    public function createAdvance()
    {
        $clients = Cache::get('clients', Client::latest()->get());
        return compact('clients');
    }

    // Advance Store
    public function storeAdvance(AdvanceRequest $request)
    {
        Advance::create($request->validated());
    }

    // Advance Show
    public function showAdvance(Advance $advance)
    {
        return compact('advance');
    }

    // Advance Edit
    public function editAdvance(Advance $advance)
    {
        $clients = Cache::get('clients', Client::latest()->get());
        return compact('advance', 'clients');
    }

    // Advance Update
    public function updateAdvance(AdvanceRequest $request, Advance $advance)
    {
        $old_advance_amount = $advance->amount;
        event(new PaymentEvent(2, $advance->client, $request, $advance, $old_advance_amount));
    }

    // Advance Destroy
    public function destroyAdvance(Advance $advance)
    {
        $advance->delete();
    }
}
