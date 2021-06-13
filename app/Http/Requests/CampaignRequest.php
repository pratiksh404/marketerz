<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'campaign_by' => Auth::user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->campaign->id ?? '';
        return [
            'code' => 'required|max:100|unique:campaigns,code,' . $id,
            'name' => 'nullable|max:255',
            'body' => 'required|max:5000',
            'description' => 'nullable|max:5000',
            'campaign_by' => 'required|numeric',
            'unit_price' => 'sometimes|numeric',
            'estimated_price' => 'sometimes|numeric',
            'client_id' => 'nullable|numeric',
            'group_id' => 'nullable|numeric',
            'channel' => 'required|numeric',
            'contacts' => 'required',
            'send_type' => 'sometimes|numeric',
            'scheduled_time' => 'sometimes'
        ];
    }
}
