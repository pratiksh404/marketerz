@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="lead" route="lead" :model="$lead">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.lead.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.lead.scripts')
@endsection