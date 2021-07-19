<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
        $id = $this->lead->id ?? '';
        return [
            'code' => 'required|max:255|unique:leads,code,' . $id,
            'name' => 'nullable|max:255',
            'description' => 'nullable|max:3000',
            'status' => 'required|numeric',
            'lead_by' => 'required|numeric',
            'assigned_to' => 'nullable|numeric',
            'contact_id' => 'required|numeric',
            'service_id' => 'required_if:package_id,null|numeric',
            'package_id' => 'required_if:service_id,null|numeric',
            'estimate_cost' => 'nullable|numeric',
            'source_id' => 'required|numeric',
            'contact_date' => 'nullable',
            'converted_to_client' => 'nullable|boolean',
            'converted_to_client_date' => 'required_if:converted_to_client,1',
        ];
    }
}
