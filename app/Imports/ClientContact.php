<?php

namespace App\Imports;

use App\Models\Admin\Client;
use App\Models\Admin\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientContact implements ToCollection, WithHeadingRow
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
            $contact->clients()->attach($this->client->id);
        }
    }
}
