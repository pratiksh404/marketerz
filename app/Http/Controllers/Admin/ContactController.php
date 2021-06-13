<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Contact;
use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ContactRequest;
use App\Contracts\ContactRepositoryInterface;

class ContactController extends Controller
{
    protected $contactRepositoryInterface;

    public function __construct(ContactRepositoryInterface $contactRepositoryInterface)
    {
        $this->contactRepositoryInterface = $contactRepositoryInterface;
        $this->authorizeResource(Contact::class, 'contact');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contact.index', $this->contactRepositoryInterface->indexContact());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $this->contactRepositoryInterface->storeContact($request);
        return redirect(adminRedirectRoute('contact'))->withSuccess('Contact Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('admin.contact.show', $this->contactRepositoryInterface->showContact($contact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('admin.contact.edit', $this->contactRepositoryInterface->editContact($contact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @param  \App\Models\Admin\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $this->contactRepositoryInterface->updateContact($request, $contact);
        return redirect(adminRedirectRoute('contact'))->withInfo('Contact Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->contactRepositoryInterface->destroyContact($contact);
        return redirect(adminRedirectRoute('contact'))->withFail('Contact Deleted Successfully.');
    }

    /**
     *
     * Import Contacts
     *
     */
    public function import()
    {
        Excel::import(new ContactsImport, request()->file('contacts_import'));
        return redirect(adminRedirectRoute('contact'))->withSuccess('Contacts Imported.');
    }

    /**
     *
     * Export Contacts
     *
     */
    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }
}
