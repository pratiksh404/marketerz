@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="task" route="task" :model="$task">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.task.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.task.scripts')
@endsection