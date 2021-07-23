<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <b>Total Counts</b>
                <div class="btn-group mx-1" role="group">
                    <button class="btn btn-primary btn-air-primary dropdown-toggle" id="totalCountFilter" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-bs-original-title="Total Count Filter" title="Total Count Filter"><i
                            class="fa fa-filter"></i></button>
                    <div class="dropdown-menu" aria-labelledby="totalCountFilter"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                        data-popper-placement="bottom-start">
                        <button class="dropdown-item" wire:click="totalCount">All Time</button>
                        <button class="dropdown-item" wire:click="todayCount">Today</button>
                        <button class="dropdown-item" wire:click="weekCount">This Week</button>
                        <button class="dropdown-item" wire:click="monthCount">This Month</button>
                        <button class="dropdown-item" wire:click="yearCount">This Year</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
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
    <div class="row" wire:loading.remove>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Total Payments</h5>
                            <p>
                                {{config('adminetic.currency_symbol','Rs.').Marketerz::totalPayment($payments)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Total Advance</h5>
                            <p>
                                {{config('adminetic.currency_symbol','Rs.').Marketerz::totalAdvance($advances)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Remaining</h5>
                            <p>
                                {{config('adminetic.currency_symbol','Rs.').Marketerz::totalRemainingAmount($projects)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Paid Amount</h5>
                            <p>
                                {{config('adminetic.currency_symbol','Rs.').Marketerz::totalPaidAmount($projects)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Total Credit</h5>
                            <p>
                                {{config('adminetic.currency_symbol','Rs.').Marketerz::totalCredit($clients)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Total Debit</h5>
                            <p>
                                {{config('adminetic.currency_symbol','Rs.').Marketerz::totalDebit($clients)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Total Projects</h5>
                            <p>
                                {{Marketerz::totalProjects($projects)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-12 box-col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Total Leads</h5>
                            <p>
                                {{Marketerz::totalLeads($leads)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('livewire_third_party')
<script>
    $(function() {
                    Livewire.on('total_count_filter_applied',function(){
                                    var notify_allow_dismiss = Boolean({{ config('adminetic.notify_allow_dismiss', true) }});
                    var notify_delay = {{ config('adminetic.notify_delay', 2000) }};
                    var notify_showProgressbar = Boolean({{ config('adminetic.notify_showProgressbar', true) }});
                    var notify_timer = {{ config('adminetic.notify_timer', 300) }};
                    var notify_newest_on_top = Boolean({{ config('adminetic.notify_newest_on_top', true) }});
                    var notify_mouse_over = Boolean({{ config('adminetic.notify_mouse_over', true) }});
                    var notify_spacing = {{ config('adminetic.notify_spacing', 1) }};
                    var notify_notify_animate_in = "{{ config('adminetic.notify_animate_in', 'animated fadeInDown') }}";
                    var notify_notify_animate_out = "{{ config('adminetic.notify_animate_out', 'animated fadeOutUp') }}";
                    var notify = $.notify({title: "<i class='{{ config('adminetic.notify_icon', 'fa fa-bell-o') }}'></i> " +
                              "Success",
                          message: "Total Count Filter Applied !"
                      }, {
                          type: 'success',
                          allow_dismiss: notify_allow_dismiss,
                          delay: notify_delay,
                          showProgressbar: notify_showProgressbar,
                          timer: notify_timer,
                          newest_on_top: notify_newest_on_top,
                          mouse_over: notify_mouse_over,
                          spacing: notify_spacing,
                          animate: {
                              enter: notify_notify_animate_in,
                              exit: notify_notify_animate_out
                          }
                      });
                    });
                    });
</script>
@endpush
</div>