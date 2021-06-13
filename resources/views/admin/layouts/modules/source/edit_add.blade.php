<div class="row">
    <div class="col-lg-12">
        <div class="mb-3" style="position: static;">
            <label for="name">Name</label>
            <input name="name" class="form-control btn-square" id="name" type="text" placeholder="Enter Source Name"
                value="{{ $source->name ?? old('name') }}">
        </div>
    </div>
    <x-adminetic-edit-add-button :model="$source ?? null" name="Source" />
</div>
