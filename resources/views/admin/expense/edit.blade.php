@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="expense" route="expense" :model="$expense">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.expense.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.expense.scripts')
@endsection