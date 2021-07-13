<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        $id = $this->project->code ?? '';
        return [
            'code' => 'required|unique:projects,code,' . $id,
            'name' => 'required|max:255',
            'description' => 'nullable|max:3000',
            'client_id' => 'required|numeric',
            'lead_id' => 'nullable|numeric',
            'service_id' => 'nullable|numeric',
            'package_id' => 'nullable|numeric',
            'department_id' => 'nullable|numeric',
            'project_head' => 'nullable|numeric',
            'project_startdate' => 'nullable',
            'project_deadline' => 'nullable|after_or_equal:project_startdate',
            'expire_date' => 'nullable|after_or_equal:project_startdate',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'paid_amount' => 'required|numeric',
            'color' => 'nullable|max:255',
            'team_notify' => 'nullable|boolean',
            'team_slack_notifiy' => 'nullable|boolean',
            'client_notifiy' => 'nullable|boolean',
            'client_service_expire_notify' => 'nullable|boolean',
            'client_payment_notify' => 'nullable|boolean',
            'client_channel' => 'nullable|boolean',
        ];
    }
}
