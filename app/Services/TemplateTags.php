<?php

namespace App\Services;

use App\Models\Admin\Contact;

class TemplateTags
{
    public static function getTags(Contact $contact = null)
    {
        $tags = [
            [
                'name' => 'Company Name',
                'tag' => ':company_name',
                'value' => setting('title', env('APP_NAME', 'Doctype Marketing')),
                'description' => 'Name of the company',
            ],
            [
                'name' => 'Company Email',
                'tag' => ':company_email',
                'value' =>  setting('email', config('adminetic.email', 'doctypenepal404@gmail.com')),
                'description' => 'Email of the company',
            ],
            [
                'name' => 'Company Phone Number',
                'tag' => ':company_phone',
                'value' => setting('phone,9843652012'),
                'description' => 'Phone Number(s) of the company',
            ],
            [
                'name' => 'Company Address',
                'tag' => ':company_address',
                'value' => setting('address', 'Somewhere'),
                'description' => 'Address of the company',
            ],
            [
                'name' => 'Contact Name',
                'tag' => ':contact_name',
                'value' => $contact->name ?? 'N/A',
                'description' => 'Name of the contacted person',
            ],
        ];
        return $tags;
    }

    public static function parseTags($message, $contact = null)
    {
        $tags = self::getTags($contact);
        $values = array();

        if (isset($tags)) {
            foreach ($tags as $tag) {
                $tag_name = str_replace(':', '', $tag['tag']);
                $values[$tag_name] = $tag['value'];
            }
        }
        return __($message, $values);
    }
}
