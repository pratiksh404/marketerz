<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:80',
            'email' => 'required_if:phone,null|max:100',
            'phone' => 'required_if:email,null|numeric',
            'gender' => 'nullable|numeric',
            'address' => 'nullable|max:100',
            'favorite' => 'nullable|boolean',
            'active' => 'nullable|boolean'
        ];
    }
}
