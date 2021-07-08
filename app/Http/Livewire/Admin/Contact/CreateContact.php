<?php

namespace App\Http\Livewire\Admin\Contact;

use Livewire\Component;
use App\Models\Admin\Group;
use App\Models\Admin\Client;
use App\Models\Admin\Contact;
use Illuminate\Support\Facades\Cache;

class CreateContact extends Component
{
    public $name;
    public $address = null;
    public $phone = null;
    public $email = null;
    public $gender = 1;
    public $active = 1;
    public $favorite = 0;

    public $groups_id;

    public $clients_id;

    protected $listeners = ['group_contacts' => 'groupContacts', 'client_contacts' => 'clientContacts'];

    protected $rules = [
        'name' => 'required|max:80',
        'email' => 'required_if:phone,null|max:100',
        'phone' => 'required_if:email,null|numeric',
        'gender' => 'nullable|numeric',
        'address' => 'nullable|max:100',
        'favorite' => 'nullable|boolean',
        'active' => 'nullable|boolean'
    ];

    public function submit()
    {
        $contact = Contact::create($this->validate());
        if (isset($this->groups_id)) {
            $contact->groups()->attach($this->groups_id);
        }
        if (isset($this->clients_id)) {
            $contact->clients()->attach($this->clients_id);
        }
        $this->emit('contact_created');
    }

    public function render()
    {
        $groups = Cache::get('groups', Group::latest()->get());
        $clients = Cache::get('clients', Client::latest()->get());
        return view('livewire.admin.contact.create-contact', compact('groups', 'clients'));
    }
}
