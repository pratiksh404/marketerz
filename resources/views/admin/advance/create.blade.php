@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="advance" route="advance">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.advance.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.advance.scripts')
@endsection