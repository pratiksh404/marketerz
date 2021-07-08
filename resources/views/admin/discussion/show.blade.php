@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="discussion" route="discussion" :model="$discussion">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="text-bold text-center">Lead Information</div>
                        <hr>
                        <span class="text-bold">Code : </span> <span
                            class="text-muted">{{$discussion->lead->code}}</span> <br>
                        <span class="text-bold">Name : </span> <span
                            class="text-muted">{{$discussion->lead->name}}</span> <br>
                        <span class="text-bold">Status : </span> <span
                            class="badge badge-{{$discussion->lead->getStatusColor()}}">{{$discussion->lead->getStatus()}}</span>
                        <br>
                        <span class="text-bold">Lead By : </span> <span
                            class="text-muted">{{$discussion->lead->leadBy->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Assigned To : </span> <span
                            class="text-muted">{{$discussion->lead->assignedTo->name ?? 'N/A'}}</span> <br>
                        <span class="text-bold">Contact : </span> <span
                            class="text-muted">{{$discussion->lead->contact->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Service : </span> <span
                            class="text-muted">{{$discussion->lead->service->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Source : </span> <span
                            class="text-muted">{{$discussion->lead->source->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Contact date : </span> <span
                            class="text-muted">{{\Carbon\Carbon::create($discussion->lead->contact_date)->toFormattedDateString() ?? 'N/A'}}</span>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="text-bold text-center">Discussion Information</div>
                        <span class="text-bold">Code : </span> <span
                            class="text-muted">{{$discussion->lead->code}}</span> <br>
                        <span class="text-bold">Name : </span> <span
                            class="text-muted">{{$discussion->lead->name}}</span> <br>
                        <span class="text-bold">Status : </span> <span
                            class="badge badge-{{$discussion->lead->getStatusColor()}}">{{$discussion->lead->getStatus()}}</span>
                        <br>
                        <span class="text-bold">Lead By : </span> <span
                            class="text-muted">{{$discussion->lead->leadBy->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Assigned To : </span> <span
                            class="text-muted">{{$discussion->lead->assignedTo->name ?? 'N/A'}}</span> <br>
                        <span class="text-bold">Contact : </span> <span
                            class="text-muted">{{$discussion->lead->contact->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Service : </span> <span
                            class="text-muted">{{$discussion->lead->service->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Source : </span> <span
                            class="text-muted">{{$discussion->lead->source->name ?? 'N/A'}}</span>
                        <br>
                        <span class="text-bold">Contact date : </span> <span
                            class="text-muted">{{\Carbon\Carbon::create($discussion->lead->contact_date)->toFormattedDateString() ?? 'N/A'}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8"></div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.discussion.scripts')
@endsection