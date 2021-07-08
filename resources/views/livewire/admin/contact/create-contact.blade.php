<div>
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
                            <input wire:model.defer="address" class="form-control btn-square" id="address" type="text"
                                placeholder="Enter Contact Address" value="{{ $address ?? old('address') }}">
                            <p class="help-block text-danger">@error('address') {{ $message }} @enderror
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3" style="position: static;">
                            <label for="phone">Contact Phone</label>
                            <input wire:model.defer="phone" class="form-control btn-square" id="phone" type="number"
                                placeholder="Enter Contact Phone" value="{{ $phone ?? old('phone') }}">
                            <p class="help-block">Required if no email given.</p>
                            <p class="help-block text-danger">@error('phone') {{ $message }} @enderror</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3" style="position: static;">
                            <label for="email">Contact Email</label>
                            <input wire:model.defer="email" class="form-control btn-square" id="email" type="email"
                                placeholder="Enter Contact Phone" value="{{ $email ?? old('email') }}">
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
                                <input wire:model.defer="gender" class="form-check-input" id="female" type="radio"
                                    name="gender" value="2" data-bs-original-title="Female" title="Female"
                                    value="{{ isset($gender) ? ($gender == 2 ? 'checked' : '') : '' }}">
                                <label class="form-check-label mb-0" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-primary">
                                <input wire:model.defer="gender" class="form-check-input" id="others" type="radio"
                                    name="gender" value="3" data-bs-original-title="Other" title="Other"
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