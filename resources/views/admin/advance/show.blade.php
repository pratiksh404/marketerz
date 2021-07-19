@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="advance" route="advance" :model="$advance">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.advance.scripts')
@endsection
