<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateRequest extends FormRequest
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
            'code' => rand(1, 100000),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->template->id ?? '';
        return [
            'code' => 'required|max:255|unique:templates,code,' . $id,
            'name' => 'required|max:255',
            'type' => 'required|numeric',
            'message' => 'required|max:5000'
        ];
    }
}
