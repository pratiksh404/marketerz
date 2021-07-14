<div>
    <div class="row">
        <div class="col-lg-12">
            <a href="#quick-service" class="text-primary" data-bs-toggle="modal" data-bs-target=".quick-service">Create
                Service ? </a>
            <div wire:ignore.self class="modal fade quick-service" id="quick_service" tabindex="-1" role="dialog"
                aria-labelledby="quickService" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="quickService">Create Service</h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="name">Service Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" wire:model.defer="name" id="name" class="form-control"
                                            placeholder="Service Name">
                                        @error('name')
                                        <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-7">
                                    <label for="price">Price</label>
                                    <div class="mb-2">
                                        <div class="input-group">
                                            <input type="number" wire:model.defer="price" id="price"
                                                class="form-control" placeholder="Service Price" value="0">
                                            @error('price')
                                            <p class="help-block text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <label for="type">Service Price Plan</label>
                                    <div class="input-group">
                                        <select wire:model.defer="type" id="type" class="form-control"
                                            style="width: 100%">

                                            <option value="1">
                                                Per Unit
                                            </option>
                                            <option value="2">
                                                Per Day
                                            </option>
                                            <option value="3">
                                                Per Week
                                            </option>
                                            <option value="4">
                                                Per Month
                                            </option>
                                            <option value="5">
                                                Per Year
                                            </option>
                                        </select>
                                        @error('type')
                                        <p class="help-block text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="button" class="btn btn-primary btn-air-primary" wire:click="submit">Create
                                Service</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    @isset($services)
    @if ($services->count() > 0)
    <div class="row">
        @foreach ($services->chunk(6) as $group)
        <div class="col-lg-12">
            @foreach ($group as $service)
            <input type="checkbox" name="services[]" class="checkbox_animated" value="{{$service->id}}"
                {{isset($model->services) ? (in_array($service->id,$model->services->pluck('id')->toArray()) ? 'checked' : '') : ''}}>{{$service->name}}
            <br>
            @endforeach
        </div>
        @endforeach
    </div>
    @endif
    @endisset
    @push('livewire_third_party')
    <script>
        $(function(){
            window.livewire.on('quick_service_created', () => $('#quick_service').modal('toggle'));
                 Livewire.on('quick_service_created', function() {
                    var notify_allow_dismiss = Boolean(
                        {{ config('adminetic.notify_allow_dismiss', true) }});
                    var notify_delay = {{ config('adminetic.notify_delay', 2000) }};
                    var notify_showProgressbar = Boolean(
                        {{ config('adminetic.notify_showProgressbar', true) }});
                    var notify_timer = {{ config('adminetic.notify_timer', 300) }};
                    var notify_newest_on_top = Boolean(
                        {{ config('adminetic.notify_newest_on_top', true) }});
                    var notify_mouse_over = Boolean(
                        {{ config('adminetic.notify_mouse_over', true) }});
                    var notify_spacing = {{ config('adminetic.notify_spacing', 1) }};
                    var notify_notify_animate_in =
                        "{{ config('adminetic.notify_animate_in', 'animated fadeInDown') }}";
                    var notify_notify_animate_out =
                        "{{ config('adminetic.notify_animate_out', 'animated fadeOutUp') }}";
                    var notify = $.notify({
                        title: "<i class='{{ config('adminetic.notify_icon', 'fa fa-bell-o') }}'></i> " +
                            "Success",
                        message: "Service Created !"
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