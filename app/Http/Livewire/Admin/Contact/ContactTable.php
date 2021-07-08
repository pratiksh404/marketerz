<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Models\Admin\Client;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Admin\Group;
use Livewire\WithPagination;
use App\Models\Admin\Contact;
use Illuminate\Support\Facades\Cache;

class ContactTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $filter;

    public $startDate;

    public $endDate;

    public $group_filter_id = null;

    public $client_filter_id = null;

    public $groups_id;

    public $clients_id;

    protected $listeners = ['date_range_filter' => 'dateRangeFilter', 'contact_created' => '$refresh'];


    public function mount()
    {
        $this->filter = 1;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function allContacts()
    {
        $this->filter = 1;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function favoriteContacts()
    {
        $this->filter = 2;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function nonFavoriteContacts()
    {
        $this->filter = 3;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function activeContacts()
    {
        $this->filter = 4;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function inActiveContacts()
    {
        $this->filter = 5;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function dateRangeFilter($startDate, $endDate)
    {
        $this->filter = 6;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function updatedSearch()
    {
        $this->filter = 7;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function groupContacts($group_id)
    {
        $this->group_filter_id = $group_id;
        $this->filter = 8;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function clientContacts($client_id)
    {
        $this->client_filter_id = $client_id;
        $this->filter = 9;
        /* Resets */
        $this->resetPage();
        $this->emit('initialize_contacts');
    }

    public function getContacts()
    {
        $filter = $this->filter;
        $contacts = Contact::latest()->paginate(10);

        if ($filter == 1) {
            return $contacts;
        } elseif ($filter == 2) {
            return Contact::favorite()->paginate(10);
        } elseif ($filter == 3) {
            return Contact::nonFavorite()->paginate(10);
        } elseif ($filter == 4) {
            return Contact::active()->paginate(10);
        } elseif ($filter == 5) {
            return Contact::inActive()->paginate(10);
        } elseif ($filter == 6) {
            $start = Carbon::create($this->startDate);
            $end = Carbon::create($this->endDate);
            return Contact::whereBetween('updated_at', [$start->toDateString(), $end->toDateString()])->paginate(10);
        } elseif ($filter == 7) {
            return Contact::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('address', 'LIKE', '%' . $this->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->paginate(10);
        } elseif ($filter == 8) {
            $group = Group::find($this->group_filter_id);
            if (isset($group)) {
                return $group->contacts()->paginate(10);
            }
        } elseif ($filter == 9) {
            $client = Client::find($this->client_filter_id);
            if (isset($client)) {
                return $client->contacts()->paginate(10);
            }
        } else {
            return $contacts;
        }
    }

    public function render()
    {
        $contacts = $this->getContacts();
        $groups = Cache::get('groups', Group::latest()->get());
        $clients = Cache::get('clients', Client::latest()->get());
        return view('livewire.admin.contact.contact-table', compact('contacts', 'groups', 'clients'));
    }
}
