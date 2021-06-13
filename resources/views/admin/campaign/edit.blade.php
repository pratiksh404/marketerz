@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="campaign" route="campaign" :model="$campaign">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.campaign.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.campaign.scripts')
@endsection