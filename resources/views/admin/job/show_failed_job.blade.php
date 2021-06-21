@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Failed Jobs</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Job</li>
                    <li class="breadcrumb-item active">Failed Jobs</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @if (isset($job))
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><b>ID : </b> <span class="text-muted">{{$job->id}}</span></li>
                    <li class="list-group-item"><b>UUID : </b> <span class="text-muted">{{$job->uuid}}</span></li>
                    <li class="list-group-item"><b>Connection : </b> <span
                            class="text-muted">{{$job->connection}}</span>
                    </li>
                    <li class="list-group-item"><b>Queue : </b> <span class="text-muted">{{$job->queue}}</span></li>
                    <li class="list-group-item"><b>Failed At : </b> <span class="text-muted">{{$job->failed_at}}</span>
                    </li>
                </ul>
            </div>
        </div>
        @isset($process)
        <div class="card shadow-lg">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <b>Contact : </b> <span class="text-muted"><a
                                href="{{adminShowRoute('contact',$process->contact->id)}}">{{$process->contact->name}}</a></span>
                    </li>
                    <li class="list-group-item">
                        <b>Campaign : </b> <span class="text-muted"><a
                                href="{{adminShowRoute('campaign',$process->campaign->id)}}">{{$process->campaign->code}}</a></span>
                    </li>
                </ul>
            </div>
        </div>
        @endisset
    </div>
    @php
    $payload = json_decode($job->payload);
    @endphp
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title">
                    {{$payload->displayName}}
                </h4>
            </div>
            <div class="card-body">
                <b class="text-center">Payload</b>
                <hr>
                <ul class="list-group">
                    <li class="list-group-item"><b>UUID </b> : <span
                            class="text-muted">{{$payload->uuid ?? 'N/A'}}</span></li>
                    <li class="list-group-item"><b>Display Name </b> : <span
                            class="text-muted">{{$payload->displayName ?? 'N/A'}}</span></li>
                    <li class="list-group-item"><b>Job </b> : <span class="text-muted">{{$payload->job ?? 'N/A'}}</span>
                    </li>
                    <li class="list-group-item"><b>Max Tries </b> : <span
                            class="text-muted">{{$payload->maxTries ?? 'N/A'}}</span></li>
                    <li class="list-group-item"><b>Max Exception </b> : <span
                            class="text-muted">{{$payload->maxExceptions ?? 'N/A'}}</span></li>
                    <li class="list-group-item"><b>Failed On TimeOut </b> : <span
                            class="text-muted">{{$payload->failOnTimeout ?? 'N/A'}}</span></li>
                    <li class="list-group-item"><b>Back Off </b> : <span
                            class="text-muted">{{$payload->backoff ?? 'N/A'}}</span></li>
                    <li class="list-group-item"><b>Time Out </b> : <span
                            class="text-muted">{{$payload->timeout ?? 'N/A'}}</span></li>
                    <li class="list-group-item"><b>Retry Untill </b> : <span
                            class="text-muted">{{$payload->retryUntil ?? 'N/A'}}</span></li>
                </ul>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title">Exception</h4>
            </div>
            <div class="card-body">
                {{$job->exception}}
            </div>
        </div>
    </div>
    @else
    <div class="col-lg-12">
        <div class="card card-shadow">
            <div class="card-body">
                <h4 class="text-center">Job not found !</h4>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('custom_js')
@include('admin.layouts.modules.job.scripts')
@endsection