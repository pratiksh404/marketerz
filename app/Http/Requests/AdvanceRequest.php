<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdvanceRequest extends FormRequest
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
        $id = $this->advance->id ?? '';
        return [
            'code' => 'required|unique:advances,code,' . $id,
            'client_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'particular' => 'nullable|max:255',
            'amount' => 'required|numeric',
            'remark' => 'nullable|max:3000',
            'payment_method' => 'sometimes|numeric'
        ];
    }
}
