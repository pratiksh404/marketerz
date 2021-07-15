@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="payment" route="payment">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.payment.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.payment.scripts')
@endsection