<?php

namespace App\Http\Livewire\Admin\Campaign;

use Livewire\Component;
use App\Models\Admin\Group;
use App\Models\Admin\Client;
use App\Models\Admin\Contact;
use Illuminate\Support\Facades\Cache;

class Contacts extends Component
{
    public $readyToLoad = false;

    public $filter_id = 1;

    public $client_id;

    public $group_id;

    public $contact_count = 0;

    protected $listeners = ['client_import_contacts' => 'clientImportContacts', 'group_import_contacts' => 'groupImportContacts'];

    public function loadContacts()
    {
        $this->readyToLoad = true;
    }

    public function clientImportContacts($id)
    {
        $this->filter_id = 2;
        $this->client_id = $id;
    }
    public function groupImportContacts($id)
    {
        $this->filter_id = 3;
        $this->group_id = $id;
    }

    public function render()
    {
        $this->emit('initialize_load_contacts');
        $contacts = $this->readyToLoad ? $this->getContacts() : null;
        $groups = Cache::get('groups', Group::latest()->get());
        $clients = Cache::get('clients', Client::latest()->get());
        return view('livewire.admin.campaign.contacts', compact('contacts', 'groups', 'clients'));
    }

    protected function getContacts()
    {
        $filter = $this->filter_id;
        if ($filter == 1) {
            return Contact::latest()->get();
        } elseif ($filter == 2) {
            $client = Client::find($this->client_id);
            return isset($client) ? $client->contacts : null;
        } elseif ($filter == 3) {
            $group = Group::find($this->group_id);
            return isset($group) ? $group->contacts : null;
        } else {
            return Contact::latest()->get();
        }
    }
}
