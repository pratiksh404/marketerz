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
                        <div class="col-lg-12">
                            @if(isset($projects))
                            <div class="float-right">
                                <input type="submit" value="Generate" class="btn btn-primary btn-air-primary">
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name/Code</th>
                                        <th>Project Head</th>
                                        <th>Project Period</th>
                                        <th>Grand Total</th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Generate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                    <tr>
                                        <td>{{isset($project->name) ? \Illuminate\Support\Str::limit($project->name,30) : ('#'.$project->code)}}
                                        </td>
                                        <td>{{$project->projectHead->name ?? 'N/A'}}</td>
                                        <td>{{$project->project_interval}}</td>
                                        <td><b>{{config('adminetic.currency_symbol','Rs.') . $project->grand_total}}</b>
                                        </td>
                                        <td><span
                                                class="text-success">{{config('adminetic.currency_symbol','Rs.') . $project->paid_amount}}</span>
                                        </td>
                                        <td><span
                                                class="text-danger">{{config('adminetic.currency_symbol','Rs.') . $project->remaining_amount}}</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="projects[]" value="{{$project->id}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <span class="text-muted">There is no project registered to this client yet.</span>
                            @endif
                        </div>
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