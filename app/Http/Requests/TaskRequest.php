<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'user_id' => Auth::user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task' => 'required|max:255',
            'description' => 'nullable|max:3000',
            'deadline' => 'nullable',
            'reminder' => 'sometimes|boolean',
            'reminder_date_time' => 'required_if:reminder,1',
            'channel' => 'required_if:reminder,1',
            'status' => 'sometimes|numeric',
            'user_id' => 'required|numeric',
            'assigned_to' => 'nullable|numeric',
            'color' => 'nullable|max:15'
        ];
    }
}
