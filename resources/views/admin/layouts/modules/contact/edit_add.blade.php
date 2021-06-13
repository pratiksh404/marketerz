<div class="row">
    <div class="col-lg-6">
        <div class="mb-3" style="position: static;">
            <label for="name">Contact Name <span class="text-danger">*</span></label>
            <input name="name" class="form-control btn-square" id="name" type="text" placeholder="Enter Contact Name"
                value="{{ $contact->name ?? old('name') }}">
            <p class="help-block text-danger">@error('name') {{ $message }} @enderror</p>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3" style="position: static;">
            <label for="name">Contact Address</label>
            <input name="address" class="form-control btn-square" id="address" type="text"
                placeholder="Enter Contact Address" value="{{ $contact->address ?? old('address') }}">
            <p class="help-block text-danger">@error('address') {{ $message }} @enderror</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="mb-3" style="position: static;">
            <label for="phone">Contact Phone</label>
            <input name="phone" class="form-control btn-square" id="phone" type="number"
                placeholder="Enter Contact Phone" value="{{ $contact->phone ?? old('phone') }}">
            <p class="help-block">Required if no email given.</p>
            <p class="help-block text-danger">@error('phone') {{ $message }} @enderror</p>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3" style="position: static;">
            <label for="email">Contact Email</label>
            <input name="email" class="form-control btn-square" id="email" type="email"
                placeholder="Enter Contact Phone" value="{{ $contact->email ?? old('email') }}">
            <p class="help-block">Required if no phone given.</p>
            <p class="help-block text-danger">@error('email') {{ $message }} @enderror</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="d-flex justify-content-between">
        <div class="media mb-2">
            <label class="col-form-label m-r-10">Favorite</label>
            <div class="media-body text-end icon-state">
                <label class="switch">
                    <input type="hidden" name="favorite" value="0">
                    <input value="1" type="checkbox" name="favorite"
                        {{ isset($contact->favorite) ? ($contact->favorite ? 'checked' : '') : (old('favorite') ? 'checked' : '') }}><span
                        class="switch-state"></span>
                </label>
            </div>
        </div>
        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
            <div class="form-check form-check-inline radio radio-primary">
                <input class="form-check-input" id="male" type="radio" name="gender" value="1"
                    data-bs-original-title="Male" title="Male"
                    value="{{ isset($contact->gender) ? ($contact->getRawOriginal('gender') == 2 ? 'checked' : '') : '' }}">
                <label class="form-check-label mb-0" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline radio radio-primary">
                <input class="form-check-input" id="female" type="radio" name="gender" value="2"
                    data-bs-original-title="Female" title="Female"
                    value="{{ isset($contact->gender) ? ($contact->getRawOriginal('gender') == 2 ? 'checked' : '') : '' }}">
                <label class="form-check-label mb-0" for="female">Female</label>
            </div>
            <div class="form-check form-check-inline radio radio-primary">
                <input class="form-check-input" id="others" type="radio" name="gender" value="3"
                    data-bs-original-title="Other" title="Other"
                    value="{{ isset($contact->gender) ? ($contact->getRawOriginal('gender') == 3 ? 'checked' : '') : '' }}">
                <label class="form-check-label mb-0" for="others">Other</label>
            </div>
        </div>
        <div class="media mb-2">
            <label class="col-form-label m-r-10">Active</label>
            <div class="media-body text-end icon-state">
                <label class="switch">
                    <input type="hidden" name="active" value="0">
                    <input value="1" type="checkbox" name="active"
                        {{ isset($contact->active) ? ($contact->active ? 'checked' : '') : 'checked' }}><span
                        class="switch-state"></span>
                </label>
            </div>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$contact ?? null" name="Contact" />
