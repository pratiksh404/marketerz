<div>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="input-group">
                    <input type="radio" name="type" value="1" checked>Project
                    <input type="radio" name="type" value="2">Campaign
                </div>
                <div class="btn-group mx-1" role="group">
                    <button class="btn btn-primary btn-air-primary dropdown-toggle" id="customFilter" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-bs-original-title="Defined Date Filterr" title="Defined Date Filterr"><i
                            class="fa fa-filter"></i></button>
                    <div class="dropdown-menu" aria-labelledby="customFilter"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                        data-popper-placement="bottom-start">
                        <button class="dropdown-item" wire:click="todayPayments">Today</button>
                        <button class="dropdown-item" wire:click="yesterdayPayments">Yesterday</button>
                        <button class="dropdown-item" wire:click="thisWeekPayments">This Week</button>
                        <button class="dropdown-item" wire:click="thisMonthPayments">This Month</button>
                        <button class="dropdown-item" wire:click="thisYearPayments">This Year</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="card-body">
                <div class="tabbed-card">
                    <ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab1" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="pills-clrhome-tab1" data-bs-toggle="pill"
                                href="#pills-reportsheet" role="tab" aria-controls="pills-reportsheet"
                                aria-selected="true">Report Sheet</a></li>
                        <li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab1" data-bs-toggle="pill"
                                href="#pills-clrprofile1" role="tab" aria-controls="pills-clrprofile1"
                                aria-selected="false">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" id="pills-clrcontact-tab1" data-bs-toggle="pill"
                                href="#pills-clrcontact1" role="tab" aria-controls="pills-clrcontact1"
                                aria-selected="false">Contact</a></li>
                    </ul>
                    <div class="tab-content" id="pills-clrtabContent1">
                        <div class="tab-pane fade show active" id="pills-reportsheet" role="tabpanel"
                            aria-labelledby="pills-clrhome-tab1">
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
                                            <h4><b>Monthly Payment Report</b></h4>
                                            <br>
                                            <h6 class="text-muted">2021 May</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                        </div>
                        <div class="tab-pane fade" id="pills-clrprofile1" role="tabpanel"
                            aria-labelledby="pills-clrprofile-tab1">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley of type
                                and scrambled it to make a type specimen book. It has survived not only five centuries,
                                but also the
                                leap into electronic typesetting, remaining essentially unchanged. It was popularised in
                                the 1960s
                                with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                        </div>
                        <div class="tab-pane fade" id="pills-clrcontact1" role="tabpanel"
                            aria-labelledby="pills-clrcontact-tab1">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the
                                industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley of type
                                and scrambled it to make a type specimen book. It has survived not only five centuries,
                                but also the
                                leap into electronic typesetting, remaining essentially unchanged. It was popularised in
                                the 1960s
                                with the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>