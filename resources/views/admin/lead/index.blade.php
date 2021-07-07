@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="lead" route="lead">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        @livewire('admin.lead.leads')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.lead.scripts')
@endsection