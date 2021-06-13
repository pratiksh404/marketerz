@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="contact" route="contact" :model="$contact">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.contact.scripts')
@endsection
