<div class="row">
    <div class="col-xl-6 xl-50 col-sm-6">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Contacts</h5>
                        <p>
                            {{$client->contacts->count() ?? 0}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 xl-50 col-sm-6">
        <div class="card bg-info">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Campaigns</h5>
                        <p>
                            {{$client->campaigns->count() ?? 0}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 xl-50 col-sm-6">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Email</h5>
                        <p>
                            {{Marketerz::totalClientEmail($client) ?? 0}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 xl-50 col-sm-6">
        <div class="card bg-success">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>SMS</h5>
                        <p>
                            {{Marketerz::totalClientSMS($client) ?? 0}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-sm-12">
        <div class="card bg-secondary">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Evaluation Cost</h5>
                        <p>
                            <b>{{config('adminetic.currency_symbol','Rs.')}}
                            </b>{{Marketerz::totalClientEvaluationCost($client) ?? 0}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-lg">
            <div class="card-header">
                <h5 class="pull-left">Email and SMS Count</h5>
            </div>
            <div class="card-body">
                <div class="tabbed-card">
                    <ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab1" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="pills-clrhome-tab1" data-bs-toggle="pill"
                                href="#pills-clrhome1" role="tab" aria-controls="pills-clrhome1" aria-selected="true"
                                data-bs-original-title="" title="">Week</a></li>
                        <li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab1" data-bs-toggle="pill"
                                href="#pills-clrprofile1" role="tab" aria-controls="pills-clrprofile1"
                                aria-selected="false" data-bs-original-title="" title="">Month</a></li>
                    </ul>
                    <div class="tab-content" id="pills-clrtabContent1">
                        <div class="tab-pane fade show active" id="pills-clrhome1" role="tabpanel"
                            aria-labelledby="pills-clrhome-tab1">
                            <div id="client_daily_email_sms_count" data-client_id="{{$client->id}}"></div>
                        </div>
                        <div class="tab-pane fade" id="pills-clrprofile1" role="tabpanel"
                            aria-labelledby="pills-clrprofile-tab1">
                            <div id="client_monthly_email_sms_count" data-client_id="{{$client->id}}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card shadow-lg">
        <div class="card-header">
            <h4 class="card-title">Monthly Email and SMS</h4>
        </div>
        <div class="card-body">
            <div id="get_client_monthly_sms_email_count" data-client_id="{{$client->id}}"></div>
        </div>
    </div>
</div>