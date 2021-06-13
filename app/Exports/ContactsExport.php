<?php

namespace App\Exports;

use App\Models\Admin\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Contact::latest()->get();
    }
}
