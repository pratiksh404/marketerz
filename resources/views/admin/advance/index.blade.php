@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Advances</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i
                                data-feather="feather feather-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Advances</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="Advance" route="advance">
    <x-slot name="content">
        <div class="row">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Registered By</th>
                        <th>Advance</th>
                        <th>Method</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($advances as $advance)
                    <tr>
                        <td><a href="{{adminShowRoute('client',$advance->client->id)}}">{{$advance->client->name}}</a>
                        </td>
                        <td>{{$advance->user->name}}</td>
                        <td>{{ config('adminetic.currency_symbol','Rs.') . $advance->amount}}</td>
                        <td><span
                                class="badge badge-{{$advance->getPaymentMethodColor()}}">{{$advance->payment_method}}</span>
                        </td>
                        <td>{{$advance->updated_at->toDayDateTimeString()}}</td>
                        <td>
                            <x-adminetic-action :model="$advance" route="advance" show="0"
                                delete="$advance->project->remaining_amount == 0 ? 0 : 1">
                                <x-slot name="buttons">
                                    <a href="{{route('advance_invoice',['advance' => $advance->id])}}"
                                        class="btn btn-primary btn-air-primary btn-sm p-2"><i
                                            class="fa fa-file-excel-o"></i></a>
                                </x-slot>
                            </x-adminetic-action>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Client</th>
                        <th>Registered By</th>
                        <th>Advance</th>
                        <th>Method</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('admin.layouts.modules.advance.statistics_scripts')
@include('admin.layouts.modules.advance.scripts')
@endsection