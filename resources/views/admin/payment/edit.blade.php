@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="payment" route="payment" :model="$payment">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.payment.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.payment.scripts')
@endsection