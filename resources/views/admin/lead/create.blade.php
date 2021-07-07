@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="lead" route="lead">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.lead.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.lead.scripts')
@endsection