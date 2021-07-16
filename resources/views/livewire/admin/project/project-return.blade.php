<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">
                                Paid Amount <br>
                                {{config('adminetic.currency_symbol','Rs.').($paid_amount ?? 0)}}
                            </span>
                            <span class="text-muted">
                                Remaining Amount <br>
                                {{config('adminetic.currency_symbol','Rs.').($remaining_amount ?? 0)}}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="price">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                                    <input type="number" id="price" class="form-control" value="{{$price ?? 0}}"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="fine">Fine</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                                    <input type="number" id="fine" class="form-control" value="{{$fine ?? 0}}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="return">Return</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                                    <input wire:model.debounce.500ms="return" type="number" name="return"
                                        class="form-control" id="return" value="{{old('return') ?? 0}}"
                                        placeholder="Return" min="0" max="{{$paid_amount ?? 0}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- HIDDEN INPUT --}}
    <input type="hidden" name="project_id" value="{{$project->id}}">
    @push('livewire_third_party')
    <script>
        $(function() {
              Livewire.on('return_amount_exceeded', function() {
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
                          message: "Return Amount Exceeded !"
                      }, {
                          type: 'danger',
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