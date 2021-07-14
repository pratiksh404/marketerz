@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="lead" route="lead" :model="$lead">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <span class="text-bold">Code : </span> <span class="text-muted">{{$lead->code}}</span>
                        <hr>
                        <span class="text-bold">Name : </span> <span class="text-muted">{{$lead->name}}</span>
                        <hr>
                        <span class="text-bold">Status : </span> <span
                            class="badge badge-{{$lead->getStatusColor()}}">{{$lead->getStatus()}}</span>
                        <hr>
                        <span class="text-bold">Lead By : </span> <span
                            class="text-muted">{{$lead->leadBy->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Assigned To : </span> <span
                            class="text-muted">{{$lead->assignedTo->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Source : </span> <span
                            class="text-muted">{{$lead->source->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Service date : </span> <span
                            class="text-muted">{{\Carbon\Carbon::create($lead->contact_date)->toFormattedDateString() ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Estimated Cost : </span> <span
                            class="text-muted">{{$lead->estimate_cost ?? 'N/A'}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="info-discussions-tab"
                                    data-bs-toggle="tab" href="#info-discussions" role="tab"
                                    aria-controls="info-discussions" aria-selected="true">Discussions</a></li>
                            <li class="nav-item"><a class="nav-link" id="info-description-tab" data-bs-toggle="tab"
                                    href="#info-description" role="tab" aria-controls="info-description"
                                    aria-selected="true">Description</a></li>
                            @isset($lead->package)
                            <li class="nav-item"><a class="nav-link" id="package-info-tab" data-bs-toggle="tab"
                                    href="#info-package" role="tab" aria-controls="info-package"
                                    aria-selected="false">Package</a>
                            </li>
                            @endisset
                            @isset($lead->services)
                            @if (!isset($lead->package))
                            <li class="nav-item"><a class="nav-link" id="service-info-tab" data-bs-toggle="tab"
                                    href="#info-service" role="tab" aria-controls="info-service"
                                    aria-selected="false"><i class="icofont icofont-services"></i>service</a></li>
                            @endif
                            @endisset
                            <li class="nav-item"><a class="nav-link" id="info-contact-tab" data-bs-toggle="tab"
                                    href="#info-contact" role="tab" aria-controls="info-contact"
                                    aria-selected="true">Contact</a></li>
                        </ul>
                        <div class="tab-content" id="info-tabContent">
                            <div class="tab-pane fade show active" id="info-discussions" role="tabpanel"
                                aria-labelledby="info-discussions-tab">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-danger btn-air-danger" type="button" data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-lg">Create Discussion</button>
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1"
                                        id="create_lead_discussion" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Lead Discussion</h4>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('store_lead_discussion')}}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        {{-- HIDDEN INPUT --}}
                                                        <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="subject">Subject</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="subject" id="subject"
                                                                            class="form-control"
                                                                            value="{{$discussion->subject ?? old('subject')}}"
                                                                            placeholder="Subject">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="type">Discussion Type</label>
                                                                    <div class="input-group">
                                                                        <select name="type" id="type"
                                                                            class="form-control" style="width: 100%">
                                                                            <option selected disabled>Select Discussion
                                                                                Type ... </option>
                                                                            <option value="1">Feedback</option>
                                                                            <option value="2">Request</option>
                                                                            <option value="3">Demand</option>
                                                                            <option value="4">Complain</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label for="type">Discussion Type</label>
                                                                    <div class="input-group">
                                                                        <select name="status" id="status"
                                                                            class="form-control">
                                                                            <option selected disabled>Select Status ...
                                                                            </option>
                                                                            <option value="1"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 1 ? "selected" : "") : ""}}>
                                                                                New
                                                                            </option>
                                                                            <option value="2"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 2 ? "selected" : "") : ""}}>
                                                                                Qualified
                                                                            </option>
                                                                            <option value="3"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 3 ? "selected" : "") : ""}}>
                                                                                Unqualified
                                                                            </option>
                                                                            <option value="4"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 4 ? "selected" : "") : ""}}>
                                                                                Discussion
                                                                            </option>
                                                                            <option value="5"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 5 ? "selected" : "") : ""}}>
                                                                                Negotiation
                                                                            </option>
                                                                            <option value="6"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 6 ? "selected" : "") : ""}}>
                                                                                Won
                                                                            </option>
                                                                            <option value="7"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 7 ? "selected" : "") : ""}}>
                                                                                Lost
                                                                            </option>
                                                                            <option value="8"
                                                                                {{isset($discussion) ? ($discussion->getRawOriginal('status') == 8 ? "selected" : "") : ""}}>
                                                                                Follow Up
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label for="discussion_date">Discussion Date</label>
                                                                    <div class="input-group">
                                                                        <input type="text" name="discussion_date"
                                                                            id="discussion_date" class="form-control"
                                                                            value="{{$lead->discussion_date ?? old('discussion_date')}}"
                                                                            placeholder="Discussion Date">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="row">
                                                                    <div class="mb-3 mt-4 col-md-12">
                                                                        <div class="d-flex date-details">
                                                                            <div class="d-inline-block">
                                                                                <label class="d-block mb-0"
                                                                                    for="chk-ani">
                                                                                    <input type="hidden" name="reminder"
                                                                                        value="0">
                                                                                    <input name="reminder"
                                                                                        class="checkbox_animated"
                                                                                        id="chk-ani" type="checkbox"
                                                                                        value="1"
                                                                                        {{isset($discussion->reminder) ? ($discussion->reminder ? 'checked' : '') : ''}}>Remind
                                                                                    on
                                                                                </label>
                                                                                @error('reminder')
                                                                                <p class="help-block text-danger">
                                                                                    {{$message}}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="d-inline-block">
                                                                                <input name="reminder_datetime"
                                                                                    class="reminder_datetime form-control"
                                                                                    id="reminder_datetime" type="text"
                                                                                    data-language="en"
                                                                                    placeholder="Date"
                                                                                    value="{{$discussion->reminder_datetime ?? old('reminder_datetime')}}"
                                                                                    disabled>
                                                                                @error('reminder_datetime')
                                                                                <p class="help-block text-danger">
                                                                                    {{$message}}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="d-inline-block">
                                                                                <input name="channel[]"
                                                                                    class="checkbox_animated"
                                                                                    id="chk-ani1" type="checkbox"
                                                                                    value="1"
                                                                                    {{isset($discussion->channel) ? (in_array(1,$discussion->channel) ? 'checked' : '') : ''}}
                                                                                    disabled>Mail
                                                                            </div>
                                                                            <div class="d-inline-block">
                                                                                <input name="channel[]"
                                                                                    class="checkbox_animated"
                                                                                    id="chk-ani2" type="checkbox"
                                                                                    value="2"
                                                                                    {{isset($discussion->channel) ? (in_array(2,$discussion->channel) ? 'checked' : '') : ''}}
                                                                                    disabled>SMS
                                                                            </div>
                                                                            <div class="d-inline-block">
                                                                                <input name="channel[]"
                                                                                    class="checkbox_animated"
                                                                                    id="chk-ani3" type="checkbox"
                                                                                    value="3"
                                                                                    {{isset($discussion->channel) ? (in_array(3,$discussion->channel) ? 'checked' : '') : ''}}
                                                                                    disabled>Slack
                                                                            </div>
                                                                            <div class="d-inline-block">
                                                                                <input name="channel[]"
                                                                                    class="checkbox_animated"
                                                                                    id="chk-ani4" type="checkbox"
                                                                                    value="4"
                                                                                    {{isset($discussion->channel) ? (in_array(4,$discussion->channel) ? 'checked' : '') : ''}}
                                                                                    disabled>System
                                                                            </div>
                                                                            @error('channel')
                                                                            <p class="help-block text-danger">
                                                                                {{$message}}</p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label for="discussion">Discussion</label>
                                                                <textarea name="discussion" id="heavytexteditor"
                                                                    cols="30" rows="10" class="heavytexteditor">
                                                                                                @isset($discussion->discussion)
                                                                                                    {!! $discussion->discussion !!}
                                                                                                @endisset
                                                                                            </textarea>
                                                            </div>
                                                        </div>
                                                        <x-adminetic-edit-add-button :model="$discussion ?? null"
                                                            name="Discussion" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @isset($discussions)
                                @if ($discussions->count() > 0)
                                <section class="cd-container p-0 m-0" id="cd-timeline" style="overflow-x:auto">
                                    @foreach ($discussions as $discussion)
                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-img cd-picture bg-{{$discussion->getTypeColor()}}"><i
                                                class="{{$discussion->getIcon()}}"></i></div>
                                        <div class="cd-timeline-content">
                                            <h6>Subject : <span class="text-muted">
                                                    {{$discussion->subject ?? 'N/A'}}</span></h6>
                                            <p class="m-0">
                                                {!! $discussion->discussion !!}
                                            </p>
                                            <hr>
                                            <div class="mt-2">
                                                <x-adminetic-action :model="$discussion" route="discussion" />
                                            </div>
                                            <span class="cd-date">
                                                Discussion By : {{$discussion->user->name ?? 'N/A'}} <br>
                                                Discussion Date :
                                                {{\Carbon\Carbon::create($discussion->discussion_date)->toFormattedDateString()}}
                                                @isset($discussion->reminder)
                                                @if ($discussion->reminder)
                                                <br>
                                                Reminder Date :
                                                {{\Carbon\Carbon::create($discussion->reminder_date)->toFormattedDateString()}}
                                                <br>
                                                Channel : @foreach($discussion->getChannelArray() as $channel)
                                                <span class="badge badge-primary">{{$channel}}</span> @endforeach
                                                @endif
                                                @endisset
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </section>
                                {{$discussions->links()}}
                                @else
                                <h4 class="text-muted">No discussion conducted yet.</h4>
                                @endif
                                @endisset
                            </div>
                            <div class="tab-pane fade" id="info-description" role="tabpanel"
                                aria-labelledby="info-description-tab">
                                <h4 class="text-center">Description</h4>
                                <hr>
                                <p>
                                    @isset($lead->description)
                                    {!! $lead->description !!}
                                    @endisset
                                </p>
                            </div>
                            @isset($lead->package)
                            <div class="tab-pane fade" id="info-package" role="tabpanel"
                                aria-labelledby="package-info-tab">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <span class="text-bold">Name : </span> <span
                                                    class="text-muted">{{$lead->package->name}}</span>
                                                <hr>
                                                <span class="text-bold">Price : </span> <span
                                                    class="text-muted">{{config('adminetic.currency_symbol','Rs.') . $lead->package->price}}</span>
                                                <hr>
                                                <span class="text-bold">Discounted Price : </span> <span
                                                    class="text-muted">{{config('adminetic.currency_symbol','Rs.') . ($lead->package->discounted_price ?? 0)}}</span>
                                                <hr>
                                                <span class="text-bold">Department : </span> <span
                                                    class="text-muted">{{$lead->package->department->name ?? 'N/A'}}</span>
                                                <hr>
                                                <span class="text-bold">Interval : </span> <span
                                                    class="text-muted">{{$lead->package->interval ?? 'N/A'}}
                                                    days</span>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <table class="table table-striped table-bordered datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Active</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @isset($lead->package->services)
                                                        @foreach ($lead->package->services as $service)
                                                        <tr>
                                                            <td>{{ $service->name }}</td>
                                                            <td><span
                                                                    class="badge badge-{{ $service->active ? 'success' : 'danger' }}">{{ $service->active ? 'Active' : 'Inactive' }}</span>
                                                            </td>
                                                            <td>
                                                                <x-adminetic-action :model="$service" route="service"
                                                                    show="0" delete="0" />
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endisset
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Active</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endisset
                            @isset($lead->services)
                            @if (!isset($lead->package))
                            <div class="tab-pane fade" id="info-service" role="tabpanel"
                                aria-labelledby="service-info-tab">
                                <table class="table table-striped table-bordered datatable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Parent</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($lead->services)
                                        @foreach ($lead->services as $package_service)
                                        <tr>
                                            <td>{{ $package_service->name }}</td>
                                            <td>{{ $package_service->parent->name ?? 'No Parent' }}</td>
                                            <td><span
                                                    class="badge badge-{{ $service->active ? 'success' : 'danger' }}">{{ $package_service->active ? 'Active' : 'Inactive' }}</span>
                                            </td>
                                            <td>
                                                <x-adminetic-action :model="$package_service" route="service" show="0"
                                                    delete="0" />
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Parent</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @endif
                            @endisset
                            <div class="tab-pane fade" id="info-contact" role="tabpanel"
                                aria-labelledby="info-contact-tab">
                                <div class="row">
                                    <div class="mb-2">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between">
                                                <b>Name : </b> <span class="text-muted">{{$lead->contact->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between">
                                                <b>Address : </b> <span
                                                    class="text-muted">{{$lead->contact->address ?? 'N/A'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between">
                                                <b>Phone : </b> <span
                                                    class="text-muted">{{$lead->contact->phone ?? 'N/A'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between">
                                                <b>Email : </b> <span
                                                    class="text-muted">{{$lead->contact->email ?? 'N/A'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
@include('admin.layouts.modules.lead.discussion_scripts')
@include('admin.layouts.modules.lead.scripts')
@endsection