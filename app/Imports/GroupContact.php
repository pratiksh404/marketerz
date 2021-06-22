<?php

namespace App\Imports;

use App\Models\Admin\Group;
use App\Models\Admin\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroupContact implements ToCollection, WithHeadingRow
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $contact = Contact::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'address' => $row['address'],
                'favorite' => $row['favorite'],
                'active' => $row['active']
            ]);
            $contact->groups()->attach($this->group->id);
        }
    }
}
