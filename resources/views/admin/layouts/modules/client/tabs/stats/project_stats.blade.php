<div class="row">
    <div class="col-xl-6 xl-50 col-sm-6">
        <div class="card bg-success">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Credit</h5>
                        <p>
                            {{config('adminetic.currency_symbol','Rs.').$client->credit ?? 0}}
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
                        <h5>Debit</h5>
                        <p>
                            {{config('adminetic.currency_symbol','Rs.').$client->debit ?? 0}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="top-payment-tab" data-bs-toggle="tab"
                    href="#top-payment" role="tab" aria-controls="top-payment" aria-selected="true">Payment</a></li>
            <li class="nav-item"><a class="nav-link" id="advance-top-tab" data-bs-toggle="tab" href="#top-advance"
                    role="tab" aria-controls="top-advance" aria-selected="false">Advance</a>
            </li>
            <li class="nav-item"><a class="nav-link" id="return-top-tab" data-bs-toggle="tab" href="#top-return"
                    role="tab" aria-controls="top-return" aria-selected="false">Return</a></li>
        </ul>
        <div class="tab-content" id="top-tabContent">
            <div class="tab-pane fade show active" id="top-payment" role="tabpanel" aria-labelledby="top-payment-tab">
                @include('admin.layouts.modules.client.tabs.stats.payment_stats')
            </div>
            <div class="tab-pane fade" id="top-advance" role="tabpanel" aria-labelledby="advance-top-tab">
                @include('admin.layouts.modules.client.tabs.stats.advance_stats')
            </div>
            <div class="tab-pane fade" id="top-return" role="tabpanel" aria-labelledby="return-top-tab">
                @include('admin.layouts.modules.client.tabs.stats.return_stats')
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach ($client->projects as $project)
    <div class="col-lg-6 col-sm-12 col-md-6">
        <div class="project-box shadow-lg">
            <div class="ribbon ribbon-bookmark ribbon-{{$project->getStatusColor()}}">
                {{$project->getStatus()}}</div>
            <br>
            <div class="d-flex justify-content-between">
                <h6>{{$project->name ?? '#'.$project->code}}</h6>

            </div>
            <div class="media">
                <img class="img-20 me-1 rounded-circle" src="{{getProfilePlaceholder($project->user->id)}}"
                    alt="{{getProfilePlaceholder($project->user->name)}}">
                @isset($project->user->roles)
                <div class="media-body">
                    <p>
                        @foreach ($project->user->roles as $role)
                        {{$role->name}},
                        @endforeach
                    </p>
                </div>
                @endisset
            </div>
            <div class="row details">
                @isset($project->client)
                <div class="col-6"><span>Interval </span></div>
                <div class="col-6 text-info">{{$project->project_interval}}</a>
                </div>
                <div class="col-6"><span>Client </span></div>
                <div class="col-6 text-primary"><a
                        href="{{adminShowRoute('client',$project->client_id)}}">{{$project->client->name ?? 'N/A'}}</a>
                </div>
                @endisset
                @isset($project->package)
                <div class="col-6"><span>Package </span></div>
                <div class="col-6 text-primary"><a
                        href="{{adminShowRoute('package',$project->package_id)}}">{{$project->package->name ?? 'N/A'}}</a>
                </div>
                @endisset
                @isset($project->projectHead)
                <div class="col-6"><span>Project Head </span></div>
                <div class="col-6 text-primary">{{$project->projectHead->name ?? 'N/A'}}</a>
                </div>
                @endisset
                @isset($project->lead)
                <div class="col-6"><span>Lead </span></div>
                <div class="col-6 text-primary"><a
                        href="{{adminShowRoute('lead',$project->lead_id)}}">{{$project->lead->name ?? '#' . $project->lead->code ?? 'N/A'}}</a>
                </div>
                @endisset
                @isset($project->department)
                <div class="col-6"><span>Department </span></div>
                <div class="col-6 text-primary"><a
                        href="{{adminShowRoute('department',$project->department_id)}}">{{$project->department->name ?? 'N/A'}}</a>
                </div>
                @endisset
                <div class="col-6"> <span>Price</span></div>
                <div class="col-6 text-success">
                    {{config('adminetic.currency_symbol','Rs.') . $project->price ?? 'N/A'}}</div>
                <div class="col-6"> <span>Discounted Price</span></div>
                <div class="col-6 text-warning">
                    {{config('adminetic.currency_symbol','Rs.') . $project->discounted_price ?? 'N/A'}}
                </div>
                <div class="col-6"> <span>Paid Amount</span></div>
                <div class="col-6 text-success">
                    {{config('adminetic.currency_symbol','Rs.') . $project->paid_amount ?? 'N/A'}}
                </div>
                <div class="col-6"> <span>Remaining Amount</span></div>
                <div class="col-6 text-danger">
                    {{config('adminetic.currency_symbol','Rs.') . $project->remaining_amount ?? 'N/A'}}
                </div>
                <div class="col-6"> <span>Fine</span></div>
                <div class="col-6 text-danger">
                    {{config('adminetic.currency_symbol','Rs.') . $project->fine ?? 'N/A'}}</div>

            </div>
            <div class="project-status mt-4">
                <div class="media mb-0">
                    <p>{{$project->deadline_percent}}% </p>
                    <div class="media-body text-end"><span>Deadline %</span></div>
                </div>
                <div class="progress" style="height: 5px">
                    <div class="progress-bar-animated bg-danger progress-bar-striped" role="progressbar"
                        style="width: {{$project->deadline_percent}}%" aria-valuenow="10" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <x-adminetic-action :model="$project" route="project" edit="{{!$project->cancel}}">
                    <x-slot name="buttons">
                        @if (!$project->cancel)
                        <a href="{{route('project_payment',['project' => $project->id])}}"
                            class="btn btn-success btn-air-success btn-sm p-2"><i class="fa fa-money"></i></a>
                        <a href="{{route('project_return',['project' => $project->id])}}"
                            class="btn btn-danger btn-air-danger btn-sm p-2"><i class="fa fa-retweet"></i></a>
                        @endif
                    </x-slot>
                </x-adminetic-action>
            </div>
        </div>
    </div>
    @endforeach
</div>