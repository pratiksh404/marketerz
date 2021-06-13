<div class="row">
    <div class="col-lg-3">
        <div class="mb-3" style="position: static;">
            <label for="name">Name</label>
            <input name="name" class="form-control btn-square" id="name" type="text" placeholder="Enter Client Name"
                value="{{ $client->name ?? old('name') }}">
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3" style="position: static;">
            <label for="phone">Phone</label>
            <input name="phone" class="form-control btn-square" id="phone" type="number"
                placeholder="Enter Client Phone" value="{{ $client->phone ?? old('phone') }}">
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3" style="position: static;">
            <label for="email">Email</label>
            <input name="email" class="form-control btn-square" id="email" type="email" placeholder="Enter Client Email"
                value="{{ $client->email ?? old('email') }}">
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3" style="position: static;">
            <label for="address">Address</label>
            <input name="address" class="form-control btn-square" id="address" type="text"
                placeholder="Enter Client Address" value="{{ $client->address ?? old('address') }}">
        </div>
    </div>
    <x-adminetic-edit-add-button :model="$client ?? null" name="Client" />
</div>
