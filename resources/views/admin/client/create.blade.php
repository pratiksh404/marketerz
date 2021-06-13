@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="client" route="client">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.client.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.client.scripts')
@endsection