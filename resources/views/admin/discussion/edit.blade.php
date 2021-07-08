@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="discussion" route="discussion" :model="$discussion">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.discussion.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.discussion.scripts')
@endsection