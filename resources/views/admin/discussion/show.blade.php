@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="discussion" route="discussion" :model="$discussion">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="text-bold text-center">Discussion Information</h4>
                        <hr>
                        <span class="text-bold">Lead : </span> <span class="text-muted"><a
                                href="{{adminShowRoute('lead',$discussion->lead->id)}}">{{$discussion->lead->code}}</a></span>
                        <hr>
                        <span class="text-bold">Type : </span><span
                            class="badge badge-{{$discussion->getTypeColor()}}">{{$discussion->type}}</span>
                        <hr>
                        <span class="text-bold">Status : </span> <span
                            class="badge badge-{{$discussion->getStatusColor()}}">{{$discussion->getStatus()}}
                        </span>
                        <hr>
                        <span class="text-bold">User : </span> <span
                            class="text-muted">{{$discussion->user->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Discussion Date : </span> <span
                            class="text-muted">{{\Carbon\Carbon::create($discussion->discussion_date)->toFormattedDateString()}}</span>
                        <span class="text-bold">Reminder : </span> <span
                            class="badge badge-{{$discussion->reminder ? 'success' : 'danger'}}">{{$discussion->reminder ? 'Yes' : 'No'}}</span>
                        <hr>
                        @isset($discussion->reminder)
                        @if ($discussion->reminder)
                        <span class="text-bold">Reminder Date : </span> <span
                            class="text-muted">{{\Carbon\Carbon::create($discussion->reminder_datetime)->toFormattedDateString()}}</span>
                        <hr>
                        <span class="text-bold">Channel : </span> @foreach($discussion->getChannelArray() as $channel)
                        <span class="badge badge-primary">{{$channel}}</span> @endforeach
                        @endif
                        @endisset
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="text-bold text-center">Lead Information</h4>
                        <hr>
                        <span class="text-bold">Code : </span> <span
                            class="text-muted">{{$discussion->lead->code}}</span>
                        <hr>
                        <span class="text-bold">Name : </span> <span
                            class="text-muted">{{$discussion->lead->name}}</span>
                        <hr>
                        <span class="text-bold">Status : </span> <span
                            class="badge badge-{{$discussion->lead->getStatusColor()}}">{{$discussion->lead->getStatus()}}</span>
                        <hr>
                        <span class="text-bold">Lead By : </span> <span
                            class="text-muted">{{$discussion->lead->leadBy->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Assigned To : </span> <span
                            class="text-muted">{{$discussion->lead->assignedTo->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Contact : </span> <span
                            class="text-muted">{{$discussion->lead->contact->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Service : </span> <span
                            class="text-muted">{{$discussion->lead->service->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Source : </span> <span
                            class="text-muted">{{$discussion->lead->source->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Contact date : </span> <span
                            class="text-muted">{{\Carbon\Carbon::create($discussion->lead->contact_date)->toFormattedDateString() ?? 'N/A'}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="text-bold">Subject</h4>
                        <span class="text-muted">{{$discussion->subject ?? 'N/A'}}</span>
                        <hr>
                        <h4 class="text-bold">Discussion :- </h4>
                        <hr>
                        <p>
                            {!! $discussion->discussion !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.discussion.scripts')
@endsection