@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Generate Client Invoice</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ adminRedirectRoute('client') }}">Clients</a>
                    </li>
                    <li class="breadcrumb-item active">Generate Client Invoice</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="Payment Invoice" route="client">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <b class="text-center">{{$client->name}}'s Projects</b>
                        <hr>
                        <form action="{{route('client_project_invoice',['client' => $client->id])}}" method="post">
                            @csrf
                            @livewire('admin.client.client-projects', ['clientid' => $client->id])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('admin.layouts.modules.client.scripts')
@endsection