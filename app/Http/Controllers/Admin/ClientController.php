<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdvanceEvent;
use App\Models\Admin\Client;
use Illuminate\Http\Request;
use App\Imports\ClientContact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\AdvanceRequest;
use App\Contracts\ClientRepositoryInterface;

class ClientController extends Controller
{
    protected $clientRepositoryInterface;

    public function __construct(ClientRepositoryInterface $clientRepositoryInterface)
    {
        $this->clientRepositoryInterface = $clientRepositoryInterface;
        $this->authorizeResource(Client::class, 'client');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.client.index', $this->clientRepositoryInterface->indexClient());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $this->clientRepositoryInterface->storeClient($request);
        return redirect(adminRedirectRoute('client'))->withSuccess('Client Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.client.show', $this->clientRepositoryInterface->showClient($client));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.client.edit', $this->clientRepositoryInterface->editClient($client));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $this->clientRepositoryInterface->updateClient($request, $client);
        return redirect(adminRedirectRoute('client'))->withInfo('Client Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->clientRepositoryInterface->destroyClient($client);
        return redirect(adminRedirectRoute('client'))->withFail('Client Deleted Successfully.');
    }

    /**
     *
     * Import Contacts
     *
     */
    public function import(Client $client)
    {
        Excel::import(new ClientContact($client), request()->file('contacts_import'));
        return redirect(adminRedirectRoute('client'))->withSuccess('Contacts Imported.');
    }

    /**
     *
     * Client Return
     *
     */
    public function client_advance(Client $client)
    {
        return view('admin.client.client_advance', compact('client'));
    }

    /**
     *
     * Store Client Return
     *
     */
    public function store_client_advance(Client $client, AdvanceRequest $request)
    {
        event(new AdvanceEvent(1, $client, $request));
        return redirect(adminRedirectRoute('client'))->withInfo('Client Advance Payment Successfull');
    }
}
