<?php

namespace App\Http\Requests;

use App\Models\Admin\Lead;
use App\Models\Admin\Client;
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (isset($this->lead_id) && !isset($this->client_id)) {
            $client_id = null;
            $lead = Lead::find($this->lead_id);
            if ($lead) {
                if ($lead->client) {
                    $client_id = $lead->client->id;
                } else {
                    $contact_name = $lead->contact->name;
                    $contact_phone = $lead->contact->phone;
                    $contact_email = $lead->contact->email;
                    $client_exist = Client::where([
                        'name' => $contact_name,
                        'phone' => $contact_phone,
                        'email' => $contact_email
                    ])->first();
                    if (isset($client_exist)) {
                        $client_id = $client_exist->id;
                    } else {
                        $client = Client::create([
                            'name' => $contact_name,
                            'phone' => $contact_phone,
                            'email' => $contact_email
                        ]);
                        $client_id = $client->id;
                    }
                }
                $this->merge([
                    'client_id' => $client_id,
                ]);
            }
        }
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
            'project_interval' => 'nullable',
            'project_startdate' => 'required',
            'project_deadline' => 'required|after_or_equal:project_startdate',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'paid_amount' => 'required|numeric',
            'color' => 'nullable|max:255',
            'team_notify' => 'nullable|boolean',
            'team_slack_notifiy' => 'nullable|boolean',
            'team_channel' => 'nullable',
            'client_notifiy' => 'nullable|boolean',
            'client_service_expire_notify' => 'nullable|boolean',
            'client_payment_notify' => 'nullable|boolean',
            'client_channel' => 'nullable',
        ];
    }
}
