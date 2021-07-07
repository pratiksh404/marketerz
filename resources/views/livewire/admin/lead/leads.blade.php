<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <div class="input-group" style="width:15vw">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                            <input type="text" class="form-control" id="lead_date_range" value="">
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-success btn-air-success dropdown-toggle" id="leadByFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="leadBy Filter" title="leadBy Filter"><i
                                    class="fa fa-users"></i></button>
                            <div class="dropdown-menu" aria-labelledby="leadByFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($users as $user)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('leadBy_leads',{{$user->id}})">{{$user->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-danger btn-air-danger dropdown-toggle" id="assignedToFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="assignedTo Filter" title="assignedTo Filter"><i
                                    class="fa fa-user"></i></button>
                            <div class="dropdown-menu" aria-labelledby="assignedToFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($users as $user)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('assignedTo_leads',{{$user->id}})">{{$user->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-warning btn-air-warning dropdown-toggle" id="serviceFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="service Filter" title="service Filter"><i
                                    class="fa fa-strikethrough"></i></button>
                            <div class="dropdown-menu" aria-labelledby="serviceFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($services as $service)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('service_leads',{{$service->id}})">{{$service->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-info btn-air-info dropdown-toggle" id="sourceFilter" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="source Filter" title="Source Filter"><i
                                    class="fa fa-tint"></i></button>
                            <div class="dropdown-menu" aria-labelledby="sourceFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($sources as $source)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('source_leads',{{$source->id}})">{{$source->name}}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        @isset($leads)
                        @if ($leads->count() > 0)
                        <div wire:ignore wire:loading.flex>
                            <div style="width:100%;align-items: center;justify-content: center;">
                                <div class="loader-box" style="margin:auto">
                                    <div class="loader-2"></div>
                                </div>
                            </div>
                        </div>
                        <div wire:loading.remove>
                            @foreach ($leads as $lead)
                            <div class="col-xxl-4 col-lg-6">
                                <div class="project-box">
                                    <div class="d-flex justify-content-between">
                                        <h6>{{$lead->name ?? '#'.$lead->code}}</h6>
                                        @livewire('admin.lead.lead-status', ['lead' => $lead], key($lead->id))
                                    </div>
                                    <div class="media"><img class="img-20 me-1 rounded-circle"
                                            src="{{getProfilePlaceholder($lead->leadBy->id)}}"
                                            alt="{{getProfilePlaceholder($lead->leadBy->name)}}" data-original-title=""
                                            title="">
                                        @isset($lead->leadBy->roles)
                                        <div class="media-body">
                                            <p>
                                                @foreach ($lead->leadBy->roles as $role)
                                                {{$role->name}},
                                                @endforeach
                                            </p>
                                        </div>
                                        @endisset
                                    </div>
                                    <div class="row details">
                                        <div class="col-6"><span>Assigned To </span></div>
                                        <div class="col-6 text-primary">{{$lead->assignedTo->name ?? 'N/A'}} </div>
                                        <div class="col-6"> <span>Contact</span></div>
                                        <div class="col-6 text-primary">{{$lead->lead->name ?? 'N/A'}}</div>
                                        <div class="col-6"> <span>Service</span></div>
                                        <div class="col-6 text-primary">{{$lead->service->name ?? 'N/A'}}</div>
                                        <div class="col-6"> <span>Source</span></div>
                                        <div class="col-6 text-primary">{{$lead->source->name ?? 'N/A'}}</div>
                                        <div class="col-6"> <span>Contact Date</span></div>
                                        <div class="col-6 text-primary">
                                            {{\Carbon\Carbon::create($lead->lead_date)->toFormattedDateString() ?? 'N/A'}}
                                        </div>
                                    </div>
                                    <div class="project-status mt-4">
                                        <div class="media mb-0">
                                            <p>{{$lead->getProgressPercent()}}% </p>
                                            <div class="media-body text-end"><span>Done</span></div>
                                        </div>
                                        <div class="progress" style="height: 5px">
                                            <div class="progress-bar-animated bg-primary progress-bar-striped"
                                                role="progressbar" style="width: {{$lead->getProgressPercent()}}%"
                                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-center">
                                        <x-adminetic-action :model="$lead" route="lead" />
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{$leads->links()}}
                        </div>
                        @else
                        <h4 class="text-center">There are no leads available right now.</h4>
                        @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function() {
            initializeLeads();
            Livewire.on('initialize_lead',function(){
                initializeLeads();
            });
               function initializeLeads() {
                    $('#lead_date_range').daterangepicker({
                        autoUpdateInput: false,
                        locale: {
                            cancelLabel: 'Clear'
                        }
                    });

                    $('#lead_date_range').on('apply.daterangepicker', function(ev, picker) {
                        let start_date = new Date($('#lead_date_range').data('daterangepicker')
                            .startDate.format('YYYY-MM-DD'));
                        let end_date = new Date($('#lead_date_range').data('daterangepicker').endDate
                            .format('YYYY-MM-DD'));
                        window.livewire.emit('date_range_filter', start_date, end_date)
                    });

                    $('#lead_date_range').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                    });
                }
            });
    </script>
    @endpush
</div>