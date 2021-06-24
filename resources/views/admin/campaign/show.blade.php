@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="campaign" route="campaign" :model="$campaign">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <b>Name </b> : <span class="text-muted">{{$campaign->name ?? 'N/A'}}</span>
                        <hr>
                        <b>Description </b> : <span class="text-muted">{{$campaign->description ?? 'N/A'}}</span>
                        <hr>
                        <b>Code </b> : <span class="text-muted">{{$campaign->code ?? 'N/A'}}</span>
                        <hr>
                        <b>Estimated Price </b> : <span
                            class="text-muted">{{$campaign->estimated_price ?? 'N/A'}}</span>
                        <hr>
                        <b>Client </b> : <span class="text-muted">{{$campaign->client->name ?? 'N/A'}}</span>
                        <hr>
                        <b>Group </b> : <span class="text-muted">{{$campaign->group->name ?? 'N/A'}}</span>
                        <hr>
                        <b>Channel </b> : <span
                            class="badge badge-{{$campaign->getRawOriginal('channel') == 1 ? 'primary' : 'warning'}}">{{$campaign->channel}}</span>
                        <hr>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical"><a class="nav-link active" id="v-pills-contact-tab"
                                data-bs-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact"
                                aria-selected="true">Contacts</a><a class="nav-link" id="v-pills-process-tab"
                                data-bs-toggle="pill" href="#v-pills-process" role="tab" aria-controls="v-pills-process"
                                aria-selected="false">Processes</a><a class="nav-link" id="v-pills-messages-tab"
                                data-bs-toggle="pill" href="#v-pills-messages" role="tab"
                                aria-controls="v-pills-messages" aria-selected="false">Messages</a><a class="nav-link"
                                id="v-pills-information-tab" data-bs-toggle="pill" href="#v-pills-information"
                                role="tab" aria-controls="v-pills-information" aria-selected="false">Information</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-contact" role="tabpanel"
                                aria-labelledby="v-pills-contact-tab">
                                <div style="overflow-x: auto">
                                    <table class="table table-responsive table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($contacts)
                                            @foreach ($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td>{{ $contact->email }}</td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-process" role="tabpanel"
                                aria-labelledby="v-pills-process-tab" style="overflow-x: auto">
                                @livewire('admin.job.processes', ['campaign'=> $campaign->id])
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                {!! $campaign->body !!}
                            </div>
                            <div class="tab-pane fade" id="v-pills-information" role="tabpanel"
                                aria-labelledby="v-pills-information-tab">
                                <div class="row">
                                    <div class="col-xl-6 xl-50 col-sm-6">
                                        <div class="card bg-primary">
                                            <div class="card-body">
                                                <div class="media faq-widgets">
                                                    <div class="media-body">
                                                        <h5>Contacts</h5>
                                                        <p>
                                                            {{count($campaign->contacts)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 xl-50 col-sm-6">
                                        <div class="card bg-info">
                                            <div class="card-body">
                                                <div class="media faq-widgets">
                                                    <div class="media-body">
                                                        <h5>Processes</h5>
                                                        <p>
                                                            {{isset($campaign->processes) ? $campaign->processes->count() : 0}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 xl-50 col-sm-6">
                                        <div class="card bg-success">
                                            <div class="card-body">
                                                <div class="media faq-widgets">
                                                    <div class="media-body">
                                                        <h5>Success</h5>
                                                        <p>
                                                            {{isset($campaign->processes) ? $campaign->processes()->where('status',1)->count() : 0}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 xl-50 col-sm-6">
                                        <div class="card bg-danger">
                                            <div class="card-body">
                                                <div class="media faq-widgets">
                                                    <div class="media-body">
                                                        <h5>Failure</h5>
                                                        <p>
                                                            {{isset($campaign->processes) ? $campaign->processes()->where('status',2)->count() : 0}}
                                                        </p>
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
            </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('admin.layouts.modules.campaign.scripts')
@endsection