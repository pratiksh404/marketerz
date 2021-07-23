<div>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="col">
                <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="radioinline1" type="radio" name="radio1" value="1"
                            wire:model="projectfrom"
                            {{isset($projectfrom) ? ($projectfrom == 1 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="radioinline1">Lead</label>
                    </div>
                    <div class="form-check form-check-inline radio radio-primary">
                        <input class="form-check-input" id="radioinline2" type="radio" name="radio1" value="2"
                            wire:model="projectfrom"
                            {{isset($projectfrom) ? ($projectfrom == 2 ? 'checked' : '') : ''}}>
                        <label class="form-check-label mb-0" for="radioinline2">Client</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LEAD --}}
    @isset($projectfrom)
    @if ($projectfrom == 1)
    <div class="card shadow-lg">
        <div class="card-body">
            <label for="leadid">Lead</label>
            <select name="lead_id" id="leadid" wire:model="leadid" class="form-control" style="width:100%">
                <option value="">Select Lead</option>
                @foreach ($leads as $select_lead)
                <option value="{{$select_lead->id}}"
                    {{isset($leadid) ? ($leadid == $select_lead->id ? 'selected' : '') : ''}}>
                    {{'code : ' . $select_lead->code . ' | Name : ' . ($lead->name ?? 'N/A') . ' | Client : ' . ($select_lead->client->name ?? 'N/A') . ' | Package : ' . ($select_lead->package->name ?? 'N/A')}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    @if (isset($lead) && $projectfrom == 1)
    <div class="card shadow-lg">
        <div class="card-body">
            <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="info-description-tab" data-bs-toggle="tab"
                        href="#info-description" role="tab" aria-controls="info-description"
                        aria-selected="true">Description</a>
                </li>
                @if ($lead->package_id)
                <li class="nav-item"><a class="nav-link" id="package-info-tab" data-bs-toggle="tab" href="#info-package"
                        role="tab" aria-controls="info-package" aria-selected="false"><i
                            class="icofont icofont-packages"></i>Package</a></li>
                @endif
                @isset($lead->services)
                @if (!isset($lead->package))
                <li class="nav-item"><a class="nav-link" id="service-info-tab" data-bs-toggle="tab" href="#info-service"
                        role="tab" aria-controls="info-service" aria-selected="false"><i
                            class="icofont icofont-man-in-glasses"></i>Service</a>
                </li>
                @endif
                @endisset
            </ul>
            <div class="tab-content" id="info-tabContent">
                <div class="tab-pane fade show active" id="info-description" role="tabpanel"
                    aria-labelledby="info-description-tab">
                    <span class="text-bold">Code : </span> <span class="text-muted"><a
                            href="{{adminShowRoute('lead',$lead->id)}}">{{$lead->code}}</a></span>
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
                        class="text-muted">{{\Carbon\Carbon::create($lead->client_date)->toFormattedDateString() ?? 'N/A'}}</span>
                    <hr>
                    <span class="text-bold">Estimated Cost : </span> <span
                        class="text-muted">{{$lead->estimate_cost ?? 'N/A'}}</span>
                </div>
                @isset($lead->package)
                <div class="tab-pane fade" id="info-package" role="tabpanel" aria-labelledby="package-info-tab">
                    <span class="text-bold">Name : </span> <span class="text-muted">{{$lead->package->name}}</span>
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
                    @isset($lead->package->services)
                    <span class="text-bold"><u>Service :- </u></span> <br>
                    <ul>
                        @foreach ($lead->package->services as $service)
                        <li>{{$service->name}}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                @endisset
                @isset($lead->services)
                @if (!isset($lead->package))
                <div class="tab-pane fade" id="info-service" role="tabpanel" aria-labelledby="service-info-tab">
                    @isset($lead->services)
                    <span class="text-bold"><u>Service :- </u></span> <br>
                    <ul>
                        @foreach ($lead->services as $service)
                        <li>{{$service->name}}</li>
                        @endforeach
                    </ul>
                    @endisset
                </div>
                @endif
                @endisset
            </div>
        </div>
    </div>
    @endif

    {{-- Client --}}

    @if ($projectfrom == 2)
    <div class="card shadow-lg">
        <div class="card-body">
            <label for="clientid">Client</label>
            <select name="client_id" id="clientid" wire:model="clientid" class="form-control" style="width:100%">
                <option value="">Select Client</option>
                @foreach ($clients as $select_client)
                <option value="{{$select_client->id}}"
                    {{isset($clientid) ? ($clientid == $select_client->id ? 'selected' : '') : ''}}>
                    {{'Name : ' . ($select_client->name ?? 'N/A') . ' | Phone : ' . ($select_client->phone ?? 'N/A') . ' | Email : ' . ($select_client->email ?? 'N/A')}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    @if (isset($client) && $projectfrom == 2)
    <div class="card shadow-lg">
        <div class="card-body">
            <b>Name </b> : <span class="text-muted">{{$client->name}}</span>
            <hr>
            <b>Address </b> : <span class="text-muted">{{$client->address}}</span>
            <hr>
            <b>Phone </b> : <span class="text-muted">{{$client->phone}}</span>
            <hr>
            <b>Email </b> : <span class="text-muted">{{$client->email}}</span>
        </div>
    </div>
    @endif

    @endisset

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-2" wire:ignore>
                        <label for="package_id">Package</label>
                        <select name="package_id" wire:model="packageid" id="package_id" class="form-control">
                            <option value="">Select Package</option>
                            @isset($packages)
                            @foreach ($packages as $select_package)
                            <option value="{{$select_package->id}}"
                                {{isset($package) ? ($packageid == $select_package->id ? 'selected' : '') : ''}}>
                                {{$select_package->name}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    @isset($package)
                    <div class="mb-2">
                        <span class="text-center">Package Detail</span>
                        <hr>
                        <span class="text-bold">Name : </span> <span class="text-muted">{{$package->name}}</span>
                        <hr>
                        <span class="text-bold">Price : </span> <span
                            class="text-muted">{{config('adminetic.currency_symbol','Rs.') . $package->price}}</span>
                        <hr>
                        <span class="text-bold">Discounted Price : </span> <span
                            class="text-muted">{{config('adminetic.currency_symbol','Rs.') . ($package->discounted_price ?? 0)}}</span>
                        <hr>
                        <span class="text-bold">Department : </span> <span
                            class="text-muted">{{$lead->package->department->name ?? 'N/A'}}</span>
                        <hr>
                        <span class="text-bold">Interval : </span> <span
                            class="text-muted">{{$package->interval ?? 'N/A'}}
                            days</span>
                        <hr>
                        @isset($lead->package->services)
                        <span class="text-bold"><u>Service :- </u></span> <br>
                        <ul>
                            @foreach ($package->services as $service)
                            <li>{{$service->name}}</li>
                            @endforeach
                        </ul>
                        @endisset
                    </div>
                    @endisset
                </div>
            </div>
            @livewire('admin.service.quick-service', ['model' => $lead ?? $project ?? null] , key('quick_service'))
        </div>
    </div>

</div>