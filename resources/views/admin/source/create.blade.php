@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="source" route="source">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.source.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.source.scripts')
@endsection