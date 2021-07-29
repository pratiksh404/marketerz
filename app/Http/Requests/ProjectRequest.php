<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Admin\Lead;
use App\Models\Admin\Client;
use Illuminate\Support\Facades\Auth;
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
                    $contact_phone = $lead->contact->phone ?? null;
                    $contact_email = $lead->contact->email ?? null;
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
                    'user_id' => $this->project->user_id ?? Auth::user()->id
                ]);
            }
        }
        $this->merge([
            'user_id' => $this->project->user_id ?? Auth::user()->id,
            'project_startdate' => Carbon::create($this->project_startdate),
            'project_deadline' => Carbon::create($this->project_deadline)
        ]);
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
            'user_id' => 'required|numeric',
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
            'fine' => 'nullable|numeric',
            'color' => 'nullable|max:255',
            'cancel' => 'sometimes"boolean',
            'cancel_date' => 'required_if:cancel,1',
            'return' => 'required_if:cancel,1|numeric',
            'return_remark' => 'nullable|max:3000',
        ];
    }
}
