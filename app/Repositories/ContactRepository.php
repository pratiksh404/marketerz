<?php

namespace App\Repositories;

use App\Models\Admin\Contact;
use Illuminate\Support\Facades\Cache;
use App\Contracts\ContactRepositoryInterface;
use App\Http\Requests\ContactRequest;

class ContactRepository implements ContactRepositoryInterface
{
    // Contact Index
    public function indexContact()
    {
        $contacts = config('coderz.caching', true)
            ? (Cache::has('contacts') ? Cache::get('contacts') : Cache::rememberForever('contacts', function () {
                return Contact::latest()->paginate(10);
            }))
            : Contact::latest()->paginate(10);
        return compact('contacts');
    }

    // Contact Create
    public function createContact()
    {
        //
    }

    // Contact Store
    public function storeContact(ContactRequest $request)
    {
        Contact::create($request->validated());
    }

    // Contact Show
    public function showContact(Contact $contact)
    {
        return compact('contact');
    }

    // Contact Edit
    public function editContact(Contact $contact)
    {
        return compact('contact');
    }

    // Contact Update
    public function updateContact(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
    }

    // Contact Destroy
    public function destroyContact(Contact $contact)
    {
        $contact->delete();
    }
}
