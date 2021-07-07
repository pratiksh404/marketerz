@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="department" route="department">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.department.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.department.scripts')
@endsection