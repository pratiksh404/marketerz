<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">
                                Paid Amount <br>
                                <span
                                    class="text-success">{{config('adminetic.currency_symbol','Rs.').($paid_amount ?? 0)}}</span>
                            </span>
                            <div id="info">
                                @isset($project->client)
                                <span class="text-muted text-primary">
                                    Client Name : {{$project->client->name ?? 'N/A'}} <br>
                                    Client Phone : {{$project->client->phone ?? 'N/A'}} <br>
                                    Client Email : {{$project->client->email ?? 'N/A'}} <br>
                                </span>
                                @endisset
                                <span class="text-muted text-primary">
                                    Project Name : {{$project->name ?? ('#' . $project->code) ?? 'N/A'}} <br>
                                </span>
                            </div>
                            <span class="text-muted">
                                Remaining Amount <br>
                                <span class="text-danger">
                                    {{config('adminetic.currency_symbol','Rs.')}} @if($errors->has('payment'))
                                    {{$original_remaining_amount}} @else {{$remaining_amount ?? 0}} @endif
                                </span>
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
                            <div class="col-lg-6">
                                <label for="payment">Payment</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                                    <input wire:model.debounce.500ms="payment" type="number" name="payment"
                                        class="form-control" id="payment" value="{{old('payment') ?? 0}}"
                                        placeholder="Payment" min="0"
                                        max="@if($errors->has('payment')) {{$original_remaining_amount}} @else {{$remaining_amount ?? 0}} @endif">
                                </div>
                                @error('payment')
                                <p class="help-block"><span class="text-danger">{{$message}}</span></p>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="particular">Particular</label>
                                    <div class="input-group">
                                        <input type="text" name="particular" id="particular" class="form-control"
                                            value="{{old('particular')}}" placeholder="Particular">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mt-3">
                                    <label for="payment_method">Payment Method</label>
                                    <div class="col">
                                        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" id="bank" type="radio"
                                                    name="payment_method" value="1" checked>
                                                <label class="form-check-label mb-0" for="bank">Bank</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" id="esewa" type="radio"
                                                    name="payment_method" value="2">
                                                <label class="form-check-label mb-0" for="esewa">e-Sewa</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" id="khalti" type="radio"
                                                    name="payment_method" value="3">
                                                <label class="form-check-label mb-0" for="khalti">Khalti</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" id="imepay" type="radio"
                                                    name="payment_method" value="4">
                                                <label class="form-check-label mb-0" for="imepay">IMEPay</label>
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
    {{-- HIDDEN INPUT --}}
    <input type="hidden" name="project_id" value="{{$project->id}}">
    @push('livewire_third_party')
    <script>
        $(function() {
              Livewire.on('remaining_amount_exceeded', function() {
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
                          message: "Payment Exceeded Remaing Amount !"
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