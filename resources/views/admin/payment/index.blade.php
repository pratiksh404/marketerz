@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Payments</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i
                                data-feather="feather feather-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Payments</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="Payment" route="payment">
    <x-slot name="content">
        <div class="row">
            <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="info-statistic-tab" data-bs-toggle="tab"
                        href="#info-statistic" role="tab" aria-controls="info-statistic" aria-selected="true"><i
                            class="fa fa-bar-chart-o"></i>Statistic</a></li>
                <li class="nav-item"><a class="nav-link" id="list-info-tab" data-bs-toggle="tab" href="#info-list"
                        role="tab" aria-controls="info-list" aria-selected="false"><i class="fa fa-bars"></i>List</a>
                </li>
            </ul>
            <div class="tab-content" id="info-tabContent">
                <div class="tab-pane fade show active" id="info-statistic" role="tabpanel"
                    aria-labelledby="info-statistic-tab">
                    @include('admin.layouts.modules.payment.statistics')
                </div>
                <div class="tab-pane fade" id="info-list" role="tabpanel" aria-labelledby="list-info-tab">
                    <div class="col-lg-12">
                        {{-- ================================Card================================ --}}
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Registered By</th>
                                    <th>Payment</th>
                                    <th>Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td><a
                                            href="{{adminShowRoute('project',$payment->project->id)}}">{{$payment->project->name ?? ('#' . $payment->project->code)}}</a>
                                    </td>
                                    <td>{{$payment->user->name}}</td>
                                    <td>{{ config('adminetic.currency_symbol','Rs.') . $payment->payment}}</td>
                                    <td><span
                                            class="badge badge-{{$payment->getPaymentMethodColor()}}">{{$payment->payment_method}}</span>
                                    </td>
                                    <td>
                                        <x-adminetic-action :model="$payment" route="payment" show="0"
                                            delete="$payment->project->remaining_amount == 0 ? 0 : 1" />
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Project</th>
                                    <th>Registered By</th>
                                    <th>Payment</th>
                                    <th>Method</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        {{-- =================================================================== --}}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('admin.layouts.modules.payment.statistics_scripts')
@include('admin.layouts.modules.payment.scripts')
@endsection