@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="task" route="task" :model="$task">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.task.scripts')
@endsection
