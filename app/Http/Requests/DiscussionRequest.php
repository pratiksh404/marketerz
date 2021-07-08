<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class DiscussionRequest extends FormRequest
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
            'lead_id' => 'required|numeric',
            'subject' => 'nullable|max:255',
            'discussion' => 'required|max:3000',
            'type' => 'nullable|numeric',
            'status' => 'required|numeric',
            'user_id' => 'required|numeric',
            'discussion_date' => 'required',
            'reminder' => 'required|boolean',
            'reminder_datetime' => 'required_if:reminder,1',
            'channel' => 'required_if:reminder,1'
        ];
    }
}
