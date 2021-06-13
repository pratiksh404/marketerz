<?php

namespace App\Http\Livewire\Admin\Contact;

use Livewire\Component;
use App\Models\Admin\Contact;

class ToggleActiveContact extends Component
{
    public $contact;

    public $active = true;

    protected $listeners = ['active_toggle' => 'activeToggle'];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
        $this->active = $contact->active;
    }


    public function activeToggle($id)
    {
        $contact = Contact::find($id);
        if (isset($contact)) {
            $contact->update([
                'active' => !$contact->active
            ]);

            $this->active = $contact->active;

            $this->contact = $contact;
        }
    }
    public function render()
    {
        return view('livewire.admin.contact.toggle-active-contact');
    }
}
