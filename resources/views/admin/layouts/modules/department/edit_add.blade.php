<div class="row">
    <div class="col-lg-10">
        <div class="mb-3">
            <label for="name">Department Name <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control"
                    value="{{$department->name ?? old('name')}}" placeholder="Department Name">
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <label for="active">Active</label>
        <div class="mb-2">
            <label class="switch">
                <input type="hidden" name="active" value="0">
                <input name="active" type="checkbox" value="1" id="active"
                    {{isset($department->active) ? ($department->active ? 'checked' : '') : 'checked'}}><span
                    class="switch-state"></span>
            </label>
        </div>
    </div>
    <x-adminetic-edit-add-button :model="$department ?? null" name="Department" />
</div>