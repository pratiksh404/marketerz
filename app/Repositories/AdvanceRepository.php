<?php

namespace App\Repositories;

use App\Models\Admin\Client;
use App\Models\Admin\Advance;
use App\Http\Requests\AdvanceRequest;
use Illuminate\Support\Facades\Cache;
use App\Contracts\AdvanceRepositoryInterface;
use App\Events\AdvanceEvent;

class AdvanceRepository implements AdvanceRepositoryInterface
{
    // Advance Index
    public function indexAdvance()
    {
        $advances = config('coderz.caching', true)
            ? (Cache::has('advances') ? Cache::get('advances') : Cache::rememberForever('advances', function () {
                return Advance::with('client', 'user')->latest()->get();
            }))
            : Advance::with('client', 'user')->latest()->get();
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
        if (isset($request->client_id)) {
            event(new AdvanceEvent(1, Client::find($request->client->id), $request));
        }
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
        event(new AdvanceEvent(2, $advance->client, $request, $advance, $old_advance_amount));
    }

    // Advance Destroy
    public function destroyAdvance(Advance $advance)
    {
        $client = $advance->client;
        if (isset($client)) {
            $payment_amount = $client->payments->sum('payment') ?? 0;
            $advance_amount = $client->advances->sum('amount') ?? 0;

            $client->update([
                'credit' => ($payment_amount - $advance_amount) > 0 ? ($payment_amount - $advance_amount) : 0,
                'debit' => ($advance_amount - $payment_amount) >= 0 ? ($advance_amount - $payment_amount) : 0,
            ]);
        }
        $advance->delete();
    }
}
