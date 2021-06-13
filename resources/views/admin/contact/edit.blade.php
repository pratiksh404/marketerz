@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="contact" route="contact" :model="$contact">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.contact.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.contact.scripts')
@endsection