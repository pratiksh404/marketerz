@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="department" route="department" :model="$department">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.department.scripts')
@endsection
