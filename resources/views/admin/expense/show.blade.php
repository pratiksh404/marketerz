@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="expense" route="expense" :model="$expense">
    <x-slot name="content">
        @if(isset($expense->remark))
        {!! $expense->remark !!}
        @else
        <h4 class="text-center">No Expense Remark Registered Yet.</h4>
        @endif
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.expense.scripts')
@endsection