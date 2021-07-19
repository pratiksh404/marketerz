@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="advance" route="advance" :model="$advance">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.advance.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.advance.scripts')
@endsection