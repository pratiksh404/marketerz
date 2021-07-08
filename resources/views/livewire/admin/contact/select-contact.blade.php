<div>
    <div class="row">
        <div class="col-lg-4">
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target=".create-quick-contact"><i class="fa fa-plus"></i></button>
        </div>
        <div class="col-lg-8" wire:ignore>
            <div class="input-group">
                <select name="contact_id" id="contact_id">
                    <option value="">Select Contact ... </option>
                    @isset($contacts)
                    @foreach ($contacts as $contact)
                    <option value="{{$contact->id}}"
                        {{isset($contact_id) ? ($contact_id == $contact->id ? 'selected' : '') : ''}}>
                        {{$contact->name . ' (' . ($contact->phone ?? $contact->email ?? 'N/A') . ' )' }}
                    </option>
                    @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div wire:ignore.self class="modal fade create-quick-contact" id="quick_contact" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Create Contact</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h4 class="card-title">Create Contact</h4>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="fa fa-spin fa-cog"></i></li>
                                    <li><i class="icofont icofont-maximize full-card"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="submit">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3" style="position: static;">
                                            <label for="name">Contact Name <span class="text-danger">*</span></label>
                                            <input wire:model.defer="name" class="form-control btn-square" id="name"
                                                type="text" placeholder="Enter Contact Name"
                                                value="{{ $name ?? old('name') }}">
                                            <p class="help-block text-danger">@error('name') {{ $message }} @enderror
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3" style="position: static;">
                                            <label for="name">Contact Address</label>
                                            <input wire:model.defer="address" class="form-control btn-square"
                                                id="address" type="text" placeholder="Enter Contact Address"
                                                value="{{ $address ?? old('address') }}">
                                            <p class="help-block text-danger">@error('address') {{ $message }} @enderror
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3" style="position: static;">
                                            <label for="phone">Contact Phone</label>
                                            <input wire:model.defer="phone" class="form-control btn-square" id="phone"
                                                type="number" placeholder="Enter Contact Phone"
                                                value="{{ $phone ?? old('phone') }}">
                                            <p class="help-block">Required if no email given.</p>
                                            <p class="help-block text-danger">@error('phone') {{ $message }} @enderror
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3" style="position: static;">
                                            <label for="email">Contact Email</label>
                                            <input wire:model.defer="email" class="form-control btn-square" id="email"
                                                type="email" placeholder="Enter Contact Phone"
                                                value="{{ $email ?? old('email') }}">
                                            <p class="help-block">Required if no phone given.</p>
                                            <p class="help-block text-danger">@error('email') {{ $message }} @enderror
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div id="multi_select_contact">
                                    <div class="row" wire:ignore>
                                        <div class="col-lg-12">
                                            <div class="mb-3" style="position: static;">
                                                <label for="email">Contact Groups</label>
                                                <select id="groups" class="select2" multiple="multiple">
                                                    @isset($groups)
                                                    @foreach ($groups as $group)
                                                    <option value="{{ $group->id }}">
                                                        {{ $group->name }}</option>
                                                    @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" wire:ignore>
                                        <div class="col-lg-12">
                                            <div class="mb-3" style="position: static;">
                                                <label for="clients">Contact Client</label>
                                                <select id="clients" class="select2" multiple="multiple">
                                                    @isset($clients)
                                                    @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->name }}</option>
                                                    @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="media mb-2">
                                            <label class="col-form-label m-r-10">Favorite</label>
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="hidden" wire:model.defer="favorite" value="0">
                                                    <input value="1" type="checkbox" wire:model.defer="favorite"
                                                        {{ isset($favorite) ? ($favorite ? 'checked' : '') : (old('favorite') ? 'checked' : '') }}><span
                                                        class="switch-state"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="media mb-2">
                                            <label class="col-form-label m-r-10">Active</label>
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="hidden" wire:model.defer="active" value="0">
                                                    <input value="1" type="checkbox" wire:model.defer="active"
                                                        {{ isset($active) ? ($active ? 'checked' : '') : 'checked' }}><span
                                                        class="switch-state"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input wire:model.defer="gender" class="form-check-input" id="male"
                                                    type="radio" name="gender" value="1" data-bs-original-title="Male"
                                                    title="Male"
                                                    value="{{ isset($gender) ? ($gender == 2 ? 'checked' : '') : '' }}">
                                                <label class="form-check-label mb-0" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input wire:model.defer="gender" class="form-check-input" id="female"
                                                    type="radio" name="gender" value="2" data-bs-original-title="Female"
                                                    title="Female"
                                                    value="{{ isset($gender) ? ($gender == 2 ? 'checked' : '') : '' }}">
                                                <label class="form-check-label mb-0" for="female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input wire:model.defer="gender" class="form-check-input" id="others"
                                                    type="radio" name="gender" value="3" data-bs-original-title="Other"
                                                    title="Other"
                                                    value="{{ isset($gender) ? ($gender == 3 ? 'checked' : '') : '' }}">
                                                <label class="form-check-label mb-0" for="others">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div wire:loading="submit">
                                    <button type="button" class="btn btn-primary btn-air-primary" disabled><i
                                            class="fa fa-spin fa-spinner"></i> Loading ...</button>
                                </div>
                                <div wire:loading.remove="submit">
                                    <button type="submit" class="btn btn-primary btn-air-primary">Add Contact</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('livewire_third_party')
    <script>
        $(function() {
            initializeContact();
                window.livewire.on('contact_created', () => $('#quick_contact').modal('toggle'));
                      Livewire.on('contact_created', function() {
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
                                  message: "Quick Contact Created !"
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

                      initializeContact();
                        });

                        function initializeContact()
                        {
                            $('#contact_id').select2();

                            $('#contact_id').on('change',function(){
                                var data = $('#contact_id').select2("val");
                                @this.set('contact_id', data);
                            });

                            $('#groups').select2({
                                dropdownParent: $('#multi_select_contact')
                            });
                            $('#groups').on('change', function(e) {
                            var data = $('#groups').select2("val");
                            @this.set('groups_id', data);
                            });
                            $('#clients').select2({
                                dropdownParent: $('#multi_select_contact')
                            });
                            $('#clients').on('change', function(e) {
                            var data = $('#clients').select2("val");
                            @this.set('clients_id', data);
                            });

                        }
                    });
    </script>
    @endpush
</div>