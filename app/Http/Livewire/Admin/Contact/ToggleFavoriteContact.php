<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Models\Admin\Contact;
use Livewire\Component;

class ToggleFavoriteContact extends Component
{
    public $contact;

    public $favorite = false;

    protected $listeners = ['favorite_toggle' => 'favoriteToggle'];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
        $this->favorite = $contact->favorite;
    }


    public function favoriteToggle($id)
    {
        $contact = Contact::find($id);
        if (isset($contact)) {
            $contact->update([
                'favorite' => !$contact->favorite
            ]);

            $this->favorite = $contact->favorite;

            $this->contact = $contact;
        }
    }

    public function render()
    {
        return view('livewire.admin.contact.toggle-favorite-contact');
    }
}
