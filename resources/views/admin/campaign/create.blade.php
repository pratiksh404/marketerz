@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="campaign" route="campaign">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.campaign.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.campaign.scripts')
@endsection