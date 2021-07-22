@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="project" route="project" :model="$project">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="ribbon ribbon-bookmark ribbon-{{$project->getStatusColor()}}">
                            {{$project->getStatus()}}</div>
                        <br>
                        <b>Code : </b> <span class="text-muted"> #{{$project->code }}</span>
                        <hr>
                        <b>Name : </b> <span class="text-muted"> {{$project->name ?? 'N/A' }}</span>
                        <hr>
                        <b>Client : </b> <span class="text-muted"> <a
                                href="{{adminShowRoute('client',$project->client_id)}}">{{$project->client->name }}</a></span>
                        <hr>
                        <b>Lead : </b> <span class="text-muted"> <a
                                href="{{adminShowRoute('lead',$project->lead_id)}}">#{{$project->lead->code }}</a></span>
                        <hr>
                        @isset($project->package)
                        <b>Package : </b> <span class="text-muted"> <a
                                href="{{adminShowRoute('package',$project->package_id)}}">{{$project->package->name }}</a></span>
                        <hr>
                        @endisset
                        @isset($project->department)
                        <b>Department : </b> <span class="text-muted"> <a
                                href="{{adminShowRoute('department',$project->department_id)}}">#{{$project->department->name }}</a></span>
                        <hr>
                        @endisset
                        @isset($project->projectHead)
                        <b>Project Head : </b> <span class="text-muted"> {{$project->projectHead->name}}</span>
                        <hr>
                        @endisset
                        <div class="project-status mt-4">
                            <div class="media mb-0">
                                <p>{{$project->deadline_percent}}% </p>
                                <div class="media-body text-end"><span>Deadline %</span></div>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar-animated bg-danger progress-bar-striped" role="progressbar"
                                    style="width: {{$project->deadline_percent}}%" aria-valuenow="10" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        @if (!$project->cancel)
                        <div class="d-flex justify-content-around">
                            <a href="{{route('project_payment',['project' => $project->id])}}"
                                class="btn btn-success btn-air-success btn-sm p-2" title="Project Payment"><i
                                    class="fa fa-money"></i></a>
                            <a href="{{route('project_return',['project' => $project->id])}}"
                                class="btn btn-danger btn-air-danger btn-sm p-2" title="Cancel Project"><i
                                    class="fa fa-retweet"></i></a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="text-bold">Notifications</div>
                        <hr>
                        <b>Team Notify : </b> {{$project->team_notify ? 'Yes' : 'No'}}
                        <br>
                        <b>Team Slack Notify : </b> {{$project->team_slack_notify ? 'Yes' : 'No'}}
                        <br>
                        @isset($project->team_channel)
                        <b>Team Channel : </b> @foreach($project->getChannelArray(1) as $channel) <span
                            class="badge badge-primary">{{$channel}}</span>
                        @endforeach
                        @endisset
                        <br>
                        <b>Client Notify : </b> {{$project->client_notify ? 'Yes' : 'No'}}
                        <br>
                        <b>Client Service Expire Notify : </b> {{$project->client_service_expire_notify ? 'Yes' : 'No'}}
                        <br>
                        <b>Client Payment Notify : </b> {{$project->client_payment_notify ? 'Yes' : 'No'}}
                        <br>
                        @isset($project->client_channel)
                        <b>Client Channel : </b> @foreach($project->getChannelArray(2) as $client_channel) <span
                            class="badge badge-primary">{{$client_channel}}</span>
                        @endforeach
                        @endisset
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="top-account-tab" data-bs-toggle="tab"
                                    href="#top-account" role="tab" aria-controls="top-account" aria-selected="true"><i
                                        class="icofont icofont-ui-account"></i>Account</a></li>
                            <li class="nav-item"><a class="nav-link" id="packageandservices-top-tab"
                                    data-bs-toggle="tab" href="#top-packageandservices" role="tab"
                                    aria-controls="top-packageandservices" aria-selected="false">Package And
                                    Services</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="invoice-top-tab" data-bs-toggle="tab"
                                    href="#top-invoice" role="tab" aria-controls="top-invoice"
                                    aria-selected="false">Invoice</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-account" role="tabpanel"
                                aria-labelledby="top-account-tab">
                                @include('admin.layouts.modules.project.tabs.account')
                            </div>
                            <div class="tab-pane fade" id="top-packageandservices" role="tabpanel"
                                aria-labelledby="packageandservices-top-tab">
                                @include('admin.layouts.modules.project.tabs.packageandservices')
                            </div>
                            <div class="tab-pane fade" id="top-invoice" role="tabpanel"
                                aria-labelledby="invoice-top-tab">
                                @include('admin.layouts.modules.project.tabs.invoice')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.project.statistic_scripts')
@include('admin.layouts.modules.project.scripts')
@endsection