@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="expense" route="expense">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.expense.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.expense.scripts')
@endsection