<div class="row">
    <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card o-hidden">
            <div class="chart-widget-top">
                <div class="row card-body">
                    <div class="col-5">
                        <h6 class="f-w-600 font-primary">SMS</h6>
                    </div>
                    <div class="col-7 text-end">
                        <h4 class="num total-value"><span class="counter">{{Marketerz::totalSMS()}}</span></h4>
                    </div>
                </div>
                <div>
                    <div id="chart-widget1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card o-hidden">
            <div class="chart-widget-top">
                <div id="chart-widget6"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card o-hidden">
            <div class="chart-widget-top">
                <div class="row card-body">
                    <div class="col-7">
                        <h6 class="f-w-600 font-secondary">Email</h6><span class="num">
                    </div>
                    <div class="col-5 text-end">
                        <h4 class="num total-value counter">{{Marketerz::totalEmails()}}</h4>
                    </div>
                </div>
                <div id="chart-widget2">
                    <div class="flot-chart-placeholder" id="chart-widget-top-second"></div>
                </div>
            </div>
        </div>
    </div>
</div>