@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="source" route="source" :model="$source">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.source.scripts')
@endsection
