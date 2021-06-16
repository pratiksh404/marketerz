<div>
    <div class="row">
        <div class="col-lg-4">
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
                                    <input wire:model.defer="name" class="form-control btn-square" id="name" type="text"
                                        placeholder="Enter Contact Name" value="{{ $name ?? old('name') }}">
                                    <p class="help-block text-danger">@error('name') {{ $message }} @enderror</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3" style="position: static;">
                                    <label for="name">Contact Address</label>
                                    <input wire:model.defer="address" class="form-control btn-square" id="address"
                                        type="text" placeholder="Enter Contact Address"
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
                                    <p class="help-block text-danger">@error('phone') {{ $message }} @enderror</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3" style="position: static;">
                                    <label for="email">Contact Email</label>
                                    <input wire:model.defer="email" class="form-control btn-square" id="email"
                                        type="email" placeholder="Enter Contact Phone"
                                        value="{{ $email ?? old('email') }}">
                                    <p class="help-block">Required if no phone given.</p>
                                    <p class="help-block text-danger">@error('email') {{ $message }} @enderror</p>
                                </div>
                            </div>
                        </div>
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
                                        <input wire:model.defer="gender" class="form-check-input" id="male" type="radio"
                                            name="gender" value="1" data-bs-original-title="Male" title="Male"
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
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    {{-- Menu Buttons --}}
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <div class="input-group" style="width:15vw">
                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    <input type="text" name="contact_date_range" id="contact_date_range" value="">
                                </div>
                                <div class="input-group" style="width:15vw">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <input type="text" wire:model.debounce.500ms="search" id="search" value="">
                                </div>
                                <div class="btn-group mx-1" role="group">
                                    <button class="btn btn-success btn-air-success dropdown-toggle" id="importExport"
                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-bs-original-title="Import Export"
                                        title="Import Export"><i class="fa fa-mail-reply-all"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="importExport"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                        data-popper-placement="bottom-start">
                                        <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                            data-bs-target=".import-contacts">Import</button>
                                        <form action="{{ route('export_contacts') }}" method="post">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Export</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="btn-group mx-1" role="group">
                                    <button class="btn btn-info btn-air-info dropdown-toggle" id="generalFilter"
                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-bs-original-title="General Filter"
                                        title="General Filter"><i class="fa fa-filter"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="generalFilter"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                        data-popper-placement="bottom-start">
                                        <button class="dropdown-item" wire:click="allContacts">All Contacts</button>
                                        <button class="dropdown-item" wire:click="favoriteContacts">Favorite
                                            Contacts</button>
                                        <button class="dropdown-item" wire:click="nonFavoriteContacts">Non Favorite
                                            Contacts</button>
                                        <button class="dropdown-item" wire:click="activeContacts">Active
                                            Contacts</button>
                                        <button class="dropdown-item" wire:click="inActiveContacts">Inactive
                                            Contacts</button>
                                    </div>
                                </div>
                                <div class="btn-group mx-1" role="group">
                                    <button class="btn btn-info btn-air-info dropdown-toggle" id="groupFilter"
                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-bs-original-title="Group Filter"
                                        title="Group Filter"><i class="fa fa-users"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="groupFilter"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                        data-popper-placement="bottom-start">
                                        @isset($groups)
                                        @foreach ($groups as $group)
                                        <button class="dropdown-item"
                                            wire:click="$emitUp('group_contacts',{{ $group->id }})">{{ $group->name }}</button>
                                        @endforeach
                                        @endisset
                                    </div>
                                </div>
                                <div class="btn-group mx-1" role="group">
                                    <button class="btn btn-warning btn-air-warning dropdown-toggle" id="clientFilter"
                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" data-bs-original-title="Client Filter"
                                        title="Group Filter"><i class="fa fa-male"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="clientFilter"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                        data-popper-placement="bottom-start">
                                        @isset($clients)
                                        @foreach ($clients as $client)
                                        <button class="dropdown-item"
                                            wire:click="$emitUp('client_contacts',{{ $client->id }})">{{ $client->name }}</button>
                                        @endforeach
                                        @endisset
                                    </div>
                                </div>
                                <a href="{{ adminCreateRoute('contact') }}"
                                    class="btn btn-primary btn-air-primary mx-1">Create
                                    Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 p-1">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div wire:ignore wire:loading.flex>
                                <div style="width:100%;align-items: center;justify-content: center;">
                                    <div class="loader-box" style="margin:auto">
                                        <div class="loader-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div wire:loading.remove>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Favorite</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($contacts)
                                        @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>
                                                @livewire('admin.contact.toggle-favorite-contact', ['contact' =>
                                                $contact],
                                                key('group' . $contact->id))
                                            </td>
                                            <td>
                                                @livewire('admin.contact.toggle-active-contact', ['contact' =>
                                                $contact],
                                                key('active' . $contact->id))
                                            </td>
                                            <td>
                                                <x-adminetic-action :model="$contact" route="contact" show="0" />
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Favorite</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Import Modal --}}
    <div class="modal fade import-contacts" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Import Contacts</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import_contacts') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <input type="file" name="contacts_import" id="contacts_import"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <a href="{{ asset('adminetic/static/contacts.xlsx') }}"
                                class="btn btn-primary btn-air-primary">Download Sample</a>
                        </div>
                        <br><br>
                        <input type="submit" value="Import" class="btn btn-primary btn-air-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function() {
                initializeContacts();
                Livewire.on('initialize_contacts', function() {
                    initializeContacts();
                });
                Livewire.on('contact_created', function() {
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
                        message: "Contact Created !"
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

                function initializeContacts() {
                    /*               $("#groups").select2({
                                      placeholder: "Select a contact groups ..",
                                      tags: true,
                                      tokenSeparators: [',', ' ']
                                  }) */

                    $('#groups').on('change', function(e) {
                        var data = $('#groups').select2("val");
                        @this.set('groups_id', data);
                    });
                    $('#clients').on('change', function(e) {
                        var data = $('#clients').select2("val");
                        @this.set('clients_id', data);
                    });

                    $('#contact_date_range').daterangepicker({
                        autoUpdateInput: false,
                        locale: {
                            cancelLabel: 'Clear'
                        }
                    });

                    $('#contact_date_range').on('apply.daterangepicker', function(ev, picker) {
                        let start_date = new Date($('#contact_date_range').data('daterangepicker')
                            .startDate.format('YYYY-MM-DD'));
                        let end_date = new Date($('#contact_date_range').data('daterangepicker').endDate
                            .format('YYYY-MM-DD'));
                        window.livewire.emit('date_range_filter', start_date, end_date)
                    });

                    $('#contact_date_range').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                    });
                }

            });

    </script>
    @endpush
</div>