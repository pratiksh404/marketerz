<div class="col-lg-12">
    <div class="mb-3">
        <div class="row">
            <div class="col-xl-6 col-md-12 box-col-12">
                <div class="card o-hidden">
                    <div class="chart-widget-top">
                        <div class="row card-body">
                            <div class="col-5">
                                <h6 class="f-w-600 font-primary">Week</h6>
                            </div>
                            <div class="col-7 text-end">
                                <h4 class="num total-value"><span class="counter">{{$week_total_payments ?? 0}}</span>
                                </h4>
                            </div>
                        </div>
                        <div>
                            <div id="week-payment"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12 box-col-12">
                <div class="card o-hidden">
                    <div class="chart-widget-top">
                        <div class="row card-body">
                            <div class="col-7">
                                <h6 class="f-w-600 font-secondary">Month</h6><span class="num">
                            </div>
                            <div class="col-5 text-end">
                                <h4 class="num total-value counter">{{$month_total_payment ?? 0}}</h4>
                            </div>
                        </div>
                        <div id="chart-widget2">
                            <div class="flot-chart-placeholder" id="monthly-payment"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-3">
        <div class="row">
            <div class="col-xl-3 col-sm-4">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media faq-widgets">
                            <div class="media-body">
                                <h5>Total Payments</h5>
                                <p>
                                    {{config('adminetic.currency_symbol','Rs.').($total_payments ?? 0)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-4">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media faq-widgets">
                            <div class="media-body">
                                <h5>Today's Payments</h5>
                                <p>
                                    {{config('adminetic.currency_symbol','Rs.').($today_total_payments ?? 0)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-4">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media faq-widgets">
                            <div class="media-body">
                                <h5>Week Payments</h5>
                                <p>
                                    {{config('adminetic.currency_symbol','Rs.').($week_total_payments ?? 0)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-4">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media faq-widgets">
                            <div class="media-body">
                                <h5>Month Payments</h5>
                                <p>
                                    {{config('adminetic.currency_symbol','Rs.').($month_total_payment ?? 0)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-4">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media faq-widgets">
                            <div class="media-body">
                                <h5>Year Payments</h5>
                                <p>
                                    {{config('adminetic.currency_symbol','Rs.').($year_total_payment ?? 0)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>