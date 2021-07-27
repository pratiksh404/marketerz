@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Project Report</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Report
                    </li>
                    <li class="breadcrumb-item active">Project Report</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@livewire('admin.report.project-report')
@endsection

@section('custom_js')
@include('admin.layouts.modules.report.scripts')
@endsection