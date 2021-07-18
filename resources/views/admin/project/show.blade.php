@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="project" route="project" :model="$project">
    <x-slot name="content">

    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.project.scripts')
@endsection