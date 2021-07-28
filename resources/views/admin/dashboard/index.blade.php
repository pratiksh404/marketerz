@extends('adminetic::admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    {{-- Total Count --}}
    @livewire('admin.statistics.total-count')
    <div class="row">
        @include('admin.layouts.modules.dashboard.charts')
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="text-center"><b>My Tasks</b></span>
                        </div>
                    </div>
                    <br>
                    @isset($tasks)
                    @if ($tasks->count() > 0)
                    <ul class="crm-activity">
                        @foreach ($tasks as $task)
                        <li>
                            <h6 class="text-muted">{{$task->task}}</h6>
                            <ul class="dates">
                                <li>{{$task->created_at->toFormattedDateString()}}</li>
                            </ul>
                            <hr>
                        </li>
                        @endforeach
                        <li class="media">
                            <div class="d-flex justify-content-center">
                                <a href="{{adminRedirectRoute('task')}}" class="btn btn-primary btn-air-primary">See
                                    All</a>
                            </div>
                        </li>
                    </ul>
                    @else
                    <span class="text-muted text-center">No Task Available</span>
                    @endif
                    @endisset
                </div>
            </div>
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <span class="text-center"><b>Leads</b></span>
                        </div>
                    </div>
                    <br>
                    @isset($leads)
                    @if ($leads->count() > 0)
                    <ul class="crm-activity">
                        @foreach ($leads as $lead)
                        <li>
                            <h6 class="text-muted"><a
                                    href="{{adminShowRoute('lead',$lead->id)}}">{{$lead->name ?? ('#'.$lead->code)}}</a>
                            </h6>
                            <ul class="dates">
                                <li>{{\Carbon\Carbon::create($lead->contact_date)->toFormattedDateString()}}</li>
                            </ul>
                            <hr>
                        </li>
                        @endforeach
                        <li class="media">
                            <div class="d-flex justify-content-center">
                                <a href="{{adminRedirectRoute('lead')}}" class="btn btn-primary btn-air-primary">See
                                    All</a>
                            </div>
                        </li>
                    </ul>
                    @else
                    <span class="text-muted text-center">No Task Available</span>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div id="project_calendar"></div>
                </div>
            </div>
            {{-- Projects --}}
            @include('admin.layouts.modules.dashboard.project_count')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    @livewire('admin.project.projects')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('custom_js')
@include('admin.layouts.modules.dashboard.scripts')
@endsection