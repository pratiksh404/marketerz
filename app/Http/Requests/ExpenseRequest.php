<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'user_id' => $this->expense->user_id ?? Auth::user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->expense->id ?? '';
        return [
            'code' => 'required|unique:expenses,code,' . $id,
            'user_id' => 'required|numeric',
            'particular' => 'nullable|max:60',
            'amount' => 'required|numeric',
            'payment_method' => 'required|numeric',
            'remark' => 'nullable|max:3000'
        ];
    }
}
