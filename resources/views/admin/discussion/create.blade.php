@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="discussion" route="discussion">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.discussion.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.discussion.scripts')
@endsection