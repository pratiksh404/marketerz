<div class="row">
    <div class="col-lg-10">
        <label for="name">Service Name <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{ $service->name ?? old('name') }}"
                placeholder="Service Name">
        </div>
    </div>
    <div class="col-lg-2">
        <label for="active">Active</label>
        <div class="mb-2">
            <label class="switch">
                <input type="hidden" name="active" value="0">
                <input name="active" type="checkbox" value="1" id="active"
                    {{isset($service->active) ? ($service->active ? 'checked' : '') : 'checked'}}><span
                    class="switch-state"></span>
            </label>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-7">
        <label for="price">Price</label>
        <div class="mb-2">
            <div class="input-group">
                <input type="number" name="price" id="price" class="form-control"
                    value="{{$service->price ?? old('price') ?? 0}}" placeholder="Service Price">
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <label for="type">Service Price Plan</label>
        <div class="input-group">
            <select name="type" id="type" class="select2" style="width: 100%">
                <option selected disabled>Select Price Plan .. </option>
                <option value="1"
                    {{isset($service->type) ? ($service->getRawOriginal('type') == 1 ? 'selected' : '') : ''}}>Per Unit
                </option>
                <option value="2"
                    {{isset($service->type) ? ($service->getRawOriginal('type') == 2 ? 'selected' : '') : ''}}>Per Day
                </option>
                <option value="3"
                    {{isset($service->type) ? ($service->getRawOriginal('type') == 3 ? 'selected' : '') : ''}}>Per Week
                </option>
                <option value="4"
                    {{isset($service->type) ? ($service->getRawOriginal('type') == 4 ? 'selected' : '') : ''}}>Per Month
                </option>
                <option value="5"
                    {{isset($service->type) ? ($service->getRawOriginal('type') == 5 ? 'selected' : '') : ''}}>Per Year
                </option>
            </select>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$service ?? null" name="Service" />