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
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="default-according" id="accordionclose">
                            <div class="card">
                                <div class="card-header" id="heading1">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse1"
                                            aria-expanded="true" aria-controls="heading1" data-bs-original-title="" title="">Payload</button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapse1" aria-labelledby="heading1" data-bs-parent="#accordionclose">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                        labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                        haven't heard of them accusamus labore sustainable VHS.</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading2">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapse2"
                                            aria-expanded="false" aria-controls="heading2" data-bs-original-title=""
                                            title="">Collapsible Group Item #<span>2</span></button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionclose">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                        labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                        haven't heard of them accusamus labore sustainable VHS.</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading3">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapse3"
                                            aria-expanded="false" aria-controls="collapse3" data-bs-original-title=""
                                            title="">Collapsible Group Item #<span>3</span></button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapse3" aria-labelledby="heading3" data-bs-parent="#accordionclose">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                        labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                        haven't heard of them accusamus labore sustainable VHS.</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading4">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapse4"
                                            aria-expanded="false" aria-controls="collapse4" data-bs-original-title=""
                                            title="">Collapsible Group Item #<span>4</span></button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapse4" aria-labelledby="heading4" data-bs-parent="#accordionclose">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                        labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                        haven't heard of them accusamus labore sustainable VHS.</div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading5">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapse5"
                                            aria-expanded="false" aria-controls="collapse5" data-bs-original-title=""
                                            title="">Collapsible Group Item #<span>5</span></button>
                                    </h5>
                                </div>
                                <div class="collapse" id="collapse5" aria-labelledby="heading5" data-bs-parent="#accordionclose">
                                    <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                        richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer
                                        labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                        Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                        haven't heard of them accusamus labore sustainable VHS.</div>
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