@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="project" route="project">
    <x-slot name="content">
        @livewire('admin.project.projects')
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.project.scripts')
@endsection