<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-primary btn-air-primary dropdown-toggle" id="customFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="custom Filter" title="custom Filter"><i
                                    class="fa fa-filter"></i></button>
                            <div class="dropdown-menu" aria-labelledby="customFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                <button class="dropdown-item" wire:click="getAllProjects">All Projects</button>
                                <button class="dropdown-item" wire:click="getRunningProject">Running Project</button>
                                <button class="dropdown-item" wire:click="getCanceledProject">Cancelled Project</button>
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-success btn-air-success dropdown-toggle" id="clientFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="client Filter" title="client Filter"><i
                                    class="fa fa-male"></i></button>
                            <div class="dropdown-menu" aria-labelledby="clientFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($clients as $client)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('client_projects',{{$client->id}})">{{$client->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-info btn-air-info dropdown-toggle" id="leadFilter" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="lead Filter" title="lead Filter"><i
                                    class="fa fa-lightbulb-o"></i></button>
                            <div class="dropdown-menu" aria-labelledby="leadFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($leads as $lead)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('lead_projects',{{$lead->id}})">{{'code : ' . $lead->code . ' | Name : ' . ($lead->name ?? 'N/A') . ' | Client : ' . ($lead->client->name ?? 'N/A') . ' | Package : ' . ($lead->package->name ?? 'N/A')}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-primary btn-air-primary dropdown-toggle" id="packageFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="package Filter" title="package Filter"><i
                                    class="fa fa-shopping-basket"></i></button>
                            <div class="dropdown-menu" aria-labelledby="packageFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($packages as $package)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('package_projects',{{$package->id}})">{{$package->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-warning btn-air-warning dropdown-toggle" id="departmentFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="department Filter" title="department Filter"><i
                                    class="fa fa-building-o"></i></button>
                            <div class="dropdown-menu" aria-labelledby="departmentFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($departments as $department)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('department_projects',{{$department->id}})">{{$department->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-danger btn-air-danger dropdown-toggle" id="project_headFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="project_head Filter" title="project_head Filter"><i
                                    class="fa fa-gavel"></i></button>
                            <div class="dropdown-menu" aria-labelledby="project_headFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($project_heads as $project_head)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('project_head_projects',{{$project_head->id}})">{{$project_head->name}}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-info btn-air-info dropdown-toggle" id="userFilter" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="user Filter" title="user Filter"><i
                                    class="fa fa-user"></i></button>
                            <div class="dropdown-menu" aria-labelledby="userFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                @foreach ($users as $user)
                                <button class="dropdown-item"
                                    wire:click="$emitUp('user_projects',{{$user->id}})">{{$user->name}}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                @isset($projects)
                @if ($projects->count() > 0)
                <div class="row">
                    <div class="col-lg-12">
                        <div wire:ignore wire:loading.flex>
                            <div style="width:100%;align-items: center;justify-content: center;">
                                <div class="loader-box" style="margin:auto">
                                    <div class="loader-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div wire:loading.remove>
                    <div class="row">
                        @foreach ($projects as $project)
                        <div class="col-lg-4 col-sm-12 col-md-6">
                            <div class="project-box shadow-lg">
                                <div class="d-flex justify-content-between">
                                    <h6>{{$project->name ?? '#'.$project->code}}</h6>

                                </div>
                                <div class="media">
                                    <img class="img-20 me-1 rounded-circle"
                                        src="{{getProfilePlaceholder($project->user->id)}}"
                                        alt="{{getProfilePlaceholder($project->user->name)}}">
                                    @isset($project->user->roles)
                                    <div class="media-body">
                                        <p>
                                            @foreach ($project->user->roles as $role)
                                            {{$role->name}},
                                            @endforeach
                                        </p>
                                    </div>
                                    @endisset
                                </div>
                                <div class="row details">
                                    @isset($project->client)
                                    <div class="col-6"><span>Interval </span></div>
                                    <div class="col-6 text-info">{{$project->project_interval}}</a>
                                    </div>
                                    <div class="col-6"><span>Client </span></div>
                                    <div class="col-6 text-primary"><a
                                            href="{{adminShowRoute('client',$project->client_id)}}">{{$project->client->name ?? 'N/A'}}</a>
                                    </div>
                                    @endisset
                                    @isset($project->package)
                                    <div class="col-6"><span>Package </span></div>
                                    <div class="col-6 text-primary"><a
                                            href="{{adminShowRoute('package',$project->package_id)}}">{{$project->package->name ?? 'N/A'}}</a>
                                    </div>
                                    @endisset
                                    @isset($project->projectHead)
                                    <div class="col-6"><span>Project Head </span></div>
                                    <div class="col-6 text-primary">{{$project->projectHead->name ?? 'N/A'}}</a>
                                    </div>
                                    @endisset
                                    @isset($project->lead)
                                    <div class="col-6"><span>Lead </span></div>
                                    <div class="col-6 text-primary"><a
                                            href="{{adminShowRoute('lead',$project->lead_id)}}">{{$project->lead->name ?? '#' . $project->lead->code ?? 'N/A'}}</a>
                                    </div>
                                    @endisset
                                    @isset($project->department)
                                    <div class="col-6"><span>Department </span></div>
                                    <div class="col-6 text-primary"><a
                                            href="{{adminShowRoute('department',$project->department_id)}}">{{$project->department->name ?? 'N/A'}}</a>
                                    </div>
                                    @endisset
                                    <div class="col-6"> <span>Price</span></div>
                                    <div class="col-6 text-success">
                                        {{config('adminetic.currency_symbol','Rs.') . $project->price ?? 'N/A'}}</div>
                                    <div class="col-6"> <span>Discounted Price</span></div>
                                    <div class="col-6 text-warning">
                                        {{config('adminetic.currency_symbol','Rs.') . $project->discounted_price ?? 'N/A'}}
                                    </div>
                                    <div class="col-6"> <span>Paid Amount</span></div>
                                    <div class="col-6 text-success">
                                        {{config('adminetic.currency_symbol','Rs.') . $project->paid_amount ?? 'N/A'}}
                                    </div>
                                    <div class="col-6"> <span>Remaining Amount</span></div>
                                    <div class="col-6 text-danger">
                                        {{config('adminetic.currency_symbol','Rs.') . $project->remaining_amount ?? 'N/A'}}
                                    </div>
                                    <div class="col-6"> <span>Fine</span></div>
                                    <div class="col-6 text-danger">
                                        {{config('adminetic.currency_symbol','Rs.') . $project->fine ?? 'N/A'}}</div>

                                </div>
                                <div class="project-status mt-4">
                                    <div class="media mb-0">
                                        <p>{{$project->deadline_percent}}% </p>
                                        <div class="media-body text-end"><span>Deadline %</span></div>
                                    </div>
                                    <div class="progress" style="height: 5px">
                                        <div class="progress-bar-animated bg-danger progress-bar-striped"
                                            role="progressbar" style="width: {{$project->deadline_percent}}%"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <x-adminetic-action :model="$project" route="project">
                                        <x-slot name="buttons">
                                            <a href="{{route('project_payment',['project' => $project->id])}}"
                                                class="btn btn-success btn-air-success btn-sm p-2"><i
                                                    class="fa fa-money"></i></a>
                                        </x-slot>
                                    </x-adminetic-action>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{$projects->links()}}
                    </div>
                </div>
                @else
                <h4 class="text-center">There are no projects available right now.</h4>
                @endif
                @endisset
            </div>
        </div>
    </div>
    {{--     @push('livewire_third_party')
    <script>
        $(function() {
                    initializeProjects();
                    Livewire.on('initialize_projects',function(){
                        initializeProjects();
                    });
                       function initializeProjects() {
                            $('#project_date_range').daterangepicker({
                                autoUpdateInput: false,
                                locale: {
                                    cancelLabel: 'Clear'
                                }
                            });
        
                            $('#project_date_range').on('apply.daterangepicker', function(ev, picker) {
                                let start_date = new Date($('#project_date_range').data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD'));
                                let end_date = new Date($('#project_date_range').data('daterangepicker').endDate
                                    .format('YYYY-MM-DD'));
                                window.livewire.emit('date_range_filter', start_date, end_date)
                            });
        
                            $('#project_date_range').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });
                        }
                    });
    </script>
    @endpush --}}
</div>