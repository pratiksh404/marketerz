<div>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="card-body">
                <div class="tabbed-card">
                    <div id="select-client" class="mb-2">
                        <span class="text-muted">Client</span>
                        <select id="clientid" wire:ignore>
                            <option value="">Select Client</option>
                            @isset($clients)
                            @foreach ($clients as $client)
                            <option value="{{$client->id}}"
                                {{isset($clientid) ? ($clientid == $client->id ? 'selected' : '') : ''}}>
                                {{$client->name}}</option>
                            @endforeach
                            @endisset
                        </select>
                        <button type="button" wire:click="clearClient" class="btn btn-primary btn-primary-air">Clear
                            Client</button>
                    </div>
                    <ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab1" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="pills-clrhome-tab1" data-bs-toggle="pill"
                                href="#pills-totalreport" role="tab" aria-controls="pills-totalreport"
                                aria-selected="true">Total Report</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab1" data-bs-toggle="pill"
                                href="#pills-monthlyreport" role="tab" aria-controls="pills-monthlyreport"
                                aria-selected="false">Monthly
                                Report</a></li>
                        <li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab1" data-bs-toggle="pill"
                                href="#pills-yearlyreport" role="tab" aria-controls="pills-yearlyreport"
                                aria-selected="false">Yearly Report</a></li>
                    </ul>
                    <div class="tab-content" id="pills-clrtabContent1">
                        <div class="tab-pane fade show active" id="pills-totalreport" role="tabpanel"
                            aria-labelledby="pills-clrhome-tab1">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex justify-content-end">
                                        <div class="input-group" wire:ignore>
                                            <span class="input-group-text">Range</span>
                                            <input type="text" id="reportdaterangepicker">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Last</span>
                                            <input type="number" wire:model="totalreportlastdays" id="days" value="1"
                                                class="form-control" placeholder="Days" min="1" max="360">
                                            <span class="input-group-text">Days Report</span>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Last</span>
                                            <input type="number" wire:model="totalreportlastmonths" id="days" value="1"
                                                class="form-control" placeholder="Months" min="1" max="12">
                                            <span class="input-group-text">Months Report</span>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-air-primary btn-sm p-2"
                                            id="print-report-button">Print</button>
                                        <div class="btn-group mx-1" role="group">
                                            <button class="btn btn-primary btn-air-primary btn-sm p-2 dropdown-toggle"
                                                id="customFilter" type="button" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-original-title="Defined Date Filterr"
                                                title="Defined Date Filterr"><i class="fa fa-filter"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="customFilter"
                                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                                data-popper-placement="bottom-start">
                                                <button class="dropdown-item" wire:click="todayProjects">Today</button>
                                                <button class="dropdown-item"
                                                    wire:click="yesterdayProjects">Yesterday</button>
                                                <button class="dropdown-item" wire:click="thisWeekProjects">This
                                                    Week</button>
                                                <button class="dropdown-item" wire:click="thisMonthProjects">This
                                                    Month</button>
                                                <button class="dropdown-item" wire:click="thisYearProjects">This
                                                    Year</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="report-print">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div id="company">
                                                <img class="media-object img-100" src="{{getLogo()}}"
                                                    alt="{{setting('title',env('APP_NAME','Marketerz'))}}"><br>
                                                <b>{{setting('title','Techcoderz Nepal')}}</b><br>
                                                <b>{{setting('address','Baneshwor, Kathmandu')}}</b><br>
                                                <b>{{setting('phone','+977 984-3276470')}}</b><br>
                                                <b>{{setting('email','info@techcoderznepal.com')}}</b><br>
                                                <b>{{setting('website','techcoderznepal.com')}}</b>
                                            </div>
                                            <div id="report-description">
                                                <br><br>
                                                @isset($clientid)
                                                @php
                                                $client = App\Models\Admin\Client::find($clientid);
                                                @endphp
                                                <b>Client : </b> <span class="text-muted">{{$client->name}}</span> <br>
                                                <b>Phone : </b> <span
                                                    class="text-muted">{{$client->phone ?? 'N/A'}}</span> <br>
                                                @endisset
                                                @isset($description)
                                                {{$description}}
                                                @endisset
                                                @isset($date)
                                                <br>
                                                <h6 class="text-muted">{{$date}}</h6>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div wire:loading.remove>
                                    @include('admin.layouts.modules.report.project.transaction_project_project_report')
                                    <hr>
                                    @include('admin.layouts.modules.report.project.total_project_project_report')
                                </div>
                            </div>
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
                        </div>
                        <div class="tab-pane fade" id="pills-monthlyreport" role="tabpanel"
                            aria-labelledby="pills-monthlyreport-tab1">
                            <button type="button" class="btn btn-primary btn-air-primary mb-2"
                                id="print-monthly-report-button">Print</button>
                            <div id="monthly-report-print">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div id="monthly-company">
                                                <img class="media-object img-100" src="{{getLogo()}}"
                                                    alt="{{setting('title',env('APP_NAME','Marketerz'))}}"><br>
                                                <b>{{setting('title','Techcoderz Nepal')}}</b><br>
                                                <b>{{setting('address','Baneshwor, Kathmandu')}}</b><br>
                                                <b>{{setting('phone','+977 984-3276470')}}</b><br>
                                                <b>{{setting('email','info@techcoderznepal.com')}}</b><br>
                                                <b>{{setting('website','techcoderznepal.com')}}</b>
                                            </div>
                                            <div id="monthly-report-description">
                                                <br><br>
                                                <select wire:model="year" class="form-control">
                                                    @foreach (range(((\Carbon\Carbon::now()->year) -
                                                    10),((\Carbon\Carbon::now()->year) + 10)) as $selected_year)
                                                    <option value="{{$selected_year}}"
                                                        {{$selected_year == (\Carbon\Carbon::now()->year) ? 'selected' : ''}}>
                                                        {{$selected_year}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @isset($clientid)
                                                @php
                                                $client = App\Models\Admin\Client::find($clientid);
                                                @endphp
                                                <b>Client : </b> <span class="text-muted">{{$client->name}}</span> <br>
                                                <b>Phone : </b> <span
                                                    class="text-muted">{{$client->phone ?? 'N/A'}}</span>
                                                <br>
                                                @endisset
                                                <br>
                                                <b>Monthly Report of </b> {{$year}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div wire:loading.remove>
                                    @include('admin.layouts.modules.report.project.total_project_monthly_project_report')
                                </div>
                            </div>
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
                        </div>
                        <div class="tab-pane fade" id="pills-yearlyreport" role="tabpanel"
                            aria-labelledby="pills-clrcontact-tab1">
                            <button type="button" class="btn btn-primary btn-air-primary mb-2"
                                id="print-yearly-report-button">Print</button>
                            <div id="yearly-report-print">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div id="yearly-company">
                                                <img class="media-object img-100" src="{{getLogo()}}"
                                                    alt="{{setting('title',env('APP_NAME','Marketerz'))}}"><br>
                                                <b>{{setting('title','Techcoderz Nepal')}}</b><br>
                                                <b>{{setting('address','Baneshwor, Kathmandu')}}</b><br>
                                                <b>{{setting('phone','+977 984-3276470')}}</b><br>
                                                <b>{{setting('email','info@techcoderznepal.com')}}</b><br>
                                                <b>{{setting('website','techcoderznepal.com')}}</b>
                                            </div>
                                            <div id="yearly-report-description">
                                                <br><br>
                                                @isset($clientid)
                                                @php
                                                $client = App\Models\Admin\Client::find($clientid);
                                                @endphp
                                                <b>Client : </b> <span class="text-muted">{{$client->name}}</span> <br>
                                                <b>Phone : </b> <span
                                                    class="text-muted">{{$client->phone ?? 'N/A'}}</span>
                                                <br>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div wire:loading.remove>
                                    @include('admin.layouts.modules.report.project.total_project_yearly_project_report')
                                </div>
                            </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function(){
            initializeProjectReport();
            Livewire.on('project_report_generated',function(){
                initializeProjectReport();
            });
            function initializeProjectReport()
            {
                $('#reportdaterangepicker').daterangepicker();

                $('#reportdaterangepicker').on('apply.daterangepicker',function(ev, picker){
                   let start_date = picker.startDate.format('YYYY-MM-DD');
                    let end_date = picker.endDate.format('YYYY-MM-DD');
                    window.livewire.emit('project_report_range_date',start_date,end_date);
                });

                $('#clientid').select2();

                $('#clientid').on('change', function (e) {
                @this.set('clientid', $(this).val());
                });
            }
            });
    </script>
    @endpush
</div>