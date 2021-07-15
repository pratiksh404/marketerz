@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="payment" route="payment">
    <x-slot name="content">
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
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.payment.scripts')
@endsection