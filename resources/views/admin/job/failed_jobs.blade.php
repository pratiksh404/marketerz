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

{{-- Failed Job --}}
@livewire('admin.job.failed-job')

@endsection

@section('custom_js')
@include('admin.layouts.modules.job.scripts')
@endsection