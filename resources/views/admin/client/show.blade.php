@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="client" route="client" :model="$client">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-3">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <b>Name </b> : <span class="text-muted">{{$client->name}}</span>
                        <hr>
                        <b>Address </b> : <span class="text-muted">{{$client->address}}</span>
                        <hr>
                        <b>Phone </b> : <span class="text-muted">{{$client->phone}}</span>
                        <hr>
                        <b>Email </b> : <span class="text-muted">{{$client->email}}</span>
                        <hr>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-statistics-tab" data-bs-toggle="pill"
                                href="#v-pills-statistics" role="tab" aria-controls="v-pills-statistics"
                                aria-selected="true">Statistics</a>
                            <a class="nav-link" id="v-pills-contact-tab" data-bs-toggle="pill" href="#v-pills-contact"
                                role="tab" aria-controls="v-pills-contact" aria-selected="true">Contacts</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-statistics" role="tabpanel"
                                aria-labelledby="v-pills-statistics-tab">
                                @include('admin.layouts.modules.client.tabs.statistics')
                            </div>
                            <div class="tab-pane fade show" id="v-pills-contact" role="tabpanel"
                                aria-labelledby="v-pills-contact-tab">
                                @include('admin.layouts.modules.client.tabs.contacts')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.client.scripts')
@endsection