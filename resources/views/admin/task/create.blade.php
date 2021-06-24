@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="task" route="task">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.task.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.task.scripts')
@endsection