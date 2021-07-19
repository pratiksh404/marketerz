<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|max:100',
            'phone' => 'required|numeric',
            'email' => 'required|max:100',
            'address' => 'nullable|max:255',
            'credit' => 'sometimes|numeric',
            'debit' => 'sometimes|numeric',
            'description' => 'nullable|max:3000'
        ];
    }
}
