@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="group" route="group" :model="$group">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.group.scripts')
@endsection
