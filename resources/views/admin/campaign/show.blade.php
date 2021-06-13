@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="campaign" route="campaign" :model="$campaign">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.campaign.scripts')
@endsection
