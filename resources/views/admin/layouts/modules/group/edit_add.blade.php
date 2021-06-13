<div class="row">
    <div class="col-lg-12">
        <label for="name">Group Name <span class="text-danger">*</span></label>
        <input name="name" class="form-control btn-square" id="name" type="text" placeholder="Enter Group Name"
            value="{{ $group->name ?? old('name') }}">
    </div>
    <x-adminetic-edit-add-button :model="$group ?? null" name="Group" />
</div>
