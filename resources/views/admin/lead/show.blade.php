@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="lead" route="lead" :model="$lead">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <span class="text-bold">Code : </span> <span class="text-muted">{{$lead->code}}</span> <br>
                        <span class="text-bold">Name : </span> <span class="text-muted">{{$lead->name}}</span> <br>
                        <span class="text-bold">Status : </span> <span
                            class="badge badge-{{$lead->getStatusColor()}}">{{$lead->getStatus()}}</span> <br>
                        <span class="text-bold">Lead By : </span> <span
                            class="text-muted">{{$lead->leadBy->name ?? 'N/A'}}</span> <br>
                        <span class="text-bold">Assigned To : </span> <span
                            class="text-muted">{{$lead->assignedTo->name ?? 'N/A'}}</span> <br>
                        <span class="text-bold">Contact : </span> <span
                            class="text-muted">{{$lead->contact->name ?? 'N/A'}}</span> <br>
                        <span class="text-bold">Service : </span> <span
                            class="text-muted">{{$lead->service->name ?? 'N/A'}}</span> <br>
                        <span class="text-bold">Source : </span> <span
                            class="text-muted">{{$lead->source->name ?? 'N/A'}}</span> <br>
                        <span class="text-bold">Contact date : </span> <span
                            class="text-muted">{{\Carbon\Carbon::create($lead->contact_date)->toFormattedDateString() ?? 'N/A'}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="text-center">Description</h4>
                        <hr>
                        <p>
                            @isset($lead->description)
                            {!! $lead->description !!}
                            @endisset
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.lead.scripts')
@endsection