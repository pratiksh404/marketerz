@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="payment" route="payment" :model="$payment">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.payment.scripts')
@endsection
