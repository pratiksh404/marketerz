<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'code' => rand(100000, 999999),
            'user_id' => Auth::user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->payment->id ?? '';
        return [
            'code' => 'required|unique:payments,code,' . $id,
            'project_id' => 'required_if:project_id,null|numeric',
            'client_id' => 'nullable|numeric',
            'campaign_id' => 'required_if:project_id,null|numeric',
            'particular' => 'nullable|max:255',
            'user_id' => 'required|numeric',
            'payment' => 'required|numeric',
            'payment_method' => 'required|numeric'
        ];
    }
}
