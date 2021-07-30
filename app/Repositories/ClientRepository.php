<?php

namespace App\Repositories;

use App\Models\Admin\Client;
use Illuminate\Support\Facades\Cache;
use App\Contracts\ClientRepositoryInterface;
use App\Http\Requests\ClientRequest;

class ClientRepository implements ClientRepositoryInterface
{
    // Client Index
    public function indexClient()
    {
        $clients = config('coderz.caching', true)
            ? (Cache::has('clients') ? Cache::get('clients') : Cache::rememberForever('clients', function () {
                return Client::latest()->get();
            }))
            : Client::latest()->get();
        return compact('clients');
    }

    // Client Create
    public function createClient()
    {
        //
    }

    // Client Store
    public function storeClient(ClientRequest $request)
    {
        Client::create($request->validated());
    }

    // Client Show
    public function showClient(Client $client)
    {
        return compact('client');
    }

    // Client Edit
    public function editClient(Client $client)
    {
        return compact('client');
    }

    // Client Update
    public function updateClient(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());
    }

    // Client Destroy
    public function destroyClient(Client $client)
    {
        $client->delete();
        Cache::has('payments') ? Cache::forget('payments') : '';
        Cache::has('advances') ? Cache::forget('advances') : '';
    }
}
