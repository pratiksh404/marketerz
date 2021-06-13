@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="group" route="group">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.group.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.group.scripts')
@endsection