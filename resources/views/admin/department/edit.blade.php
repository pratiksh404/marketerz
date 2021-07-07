@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="department" route="department" :model="$department">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.department.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.department.scripts')
@endsection