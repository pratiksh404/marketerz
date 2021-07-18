@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Project #{{$project->code}} Return</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"> <svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{adminRedirectRoute('project')}}">Project</a>
                    </li>
                    <li class="breadcrumb-item active">Project Return</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<form action="{{route('store_project_return',['project' => $project->id])}}" method="post">
    @csrf
    @livewire('admin.project.project-return', ['project' => $project])
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-2">
                                <label for="cancel_date">Cancel Date</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                    <input type="text" name="cancel_date" id="cancel_date" class="form-control"
                                        value="{{$project->cancel_date ?? \Carbon\Carbon::now()}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-2">
                                <label for="return_remark">Return Remark</label>
                                <textarea name="return_remark" id="heavytexteditor" cols="30" rows="10">
                               @isset($project->return_remark)
                                   {!! $project->return_remark !!}
                               @endisset
                           </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Execute
        Return Transaction</button>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Confirm Return Transaction</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center text-bold text-danger">Are you sure you want to cancel this project and
                        return the amount ?</div>
                    <br>
                    <div class="text-center text-bold">Project Detail</div>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>Code</b> <span class="text-muted">#{{$project->code}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>client_id</b> <span class="text-muted">{{$project->client->name ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Lead</b> <span
                                class="text-muted">{{$project->lead->name ?? $project->lead->code ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Package</b> <span class="text-muted">{{$project->package->name ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Department</b> <span class="text-muted">{{$project->department->name ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Project Head</b> <span class="text-muted">{{$project->projectHead->name ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Price</b> <span
                                class="text-muted">{{config('adminetic.currency_symbol','Rs.').$project->valid_price ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Paid Amount</b> <span
                                class="text-muted">{{config('adminetic.currency_symbol','Rs.').$project->paid_amount ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Fine</b> <span
                                class="text-muted">{{config('adminetic.currency_symbol','Rs.').$project->fine ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Project Interval</b> <span
                                class="text-muted">{{$project->project_interval ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <span class="text-muted">{{$project->getStatus() ?? 'N/A'}}</span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Confirm" class="btn btn-primary btn-air-primary">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('custom_js')
@include('admin.layouts.modules.project.scripts')
@endsection