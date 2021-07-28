@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="expense" route="expense">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Registered By</th>
                    <th>Particular</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                <tr>
                    <td>#{{$expense->code}}</td>
                    <td>{{$expense->user->name}}</td>
                    <td>{{$expense->particular}}</td>
                    <td>{{config('adminetic.currency_symbol','Rs.') . $expense->amount}}</td>
                    <td><span
                            class="badge badge-{{$expense->getPaymentMethodColor()}}">{{$expense->payment_method}}</span>
                    </td>
                    <td>
                        <x-adminetic-action :model="$expense" route="expense" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Code</th>
                    <th>Registered By</th>
                    <th>Particular</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.expense.scripts')
@endsection