@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="source" route="source" :model="$source">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.source.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.source.scripts')
@endsection