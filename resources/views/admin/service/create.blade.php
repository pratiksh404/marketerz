@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="service" route="service">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.service.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.service.scripts')
@endsection