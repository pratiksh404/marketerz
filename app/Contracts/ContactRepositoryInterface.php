<?php

namespace App\Contracts;

use App\Models\Admin\Contact;
use App\Http\Requests\ContactRequest;

interface ContactRepositoryInterface
{
    public function indexContact();

    public function createContact();

    public function storeContact(ContactRequest $request);

    public function showContact(Contact $Contact);

    public function editContact(Contact $Contact);

    public function updateContact(ContactRequest $request, Contact $Contact);

    public function destroyContact(Contact $Contact);
}
