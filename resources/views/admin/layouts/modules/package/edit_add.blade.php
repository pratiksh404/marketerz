<div class="row">
    <div class="col-lg-8">
        <div class="mb-3">
            <label for="name">Package Name</label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" value="{{$package->name ?? old('name')}}"
                    placeholder="Package Name">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="interval">Package Interval (in days)</label>
            <div class="input-group">
                <input type="number" name="interval" id="interval" class="touchspin"
                    value="{{$package->interval ?? old('interval')}}" placeholder="Package Interval (in days)">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="price">Price</label>
            <div class="input-group">
                <input type="number" name="price" id="price" class="touchspin"
                    value="{{$package->price ?? old('price') ?? 0}}" placeholder="Package Price">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="discounted_price">Discounted Price</label>
            <div class="input-group">
                <input type="number" name="discounted_price" id="discounted_price" class="touchspin"
                    value="{{$package->discounted_price ?? old('discounted_price')}}" placeholder="Discounted Price">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="department_id">Department</label>
            <div class="input-group">
                <select name="department_id" id="department_id" class="select2" style="width: 100%">
                    <option selected disabled>Select Department ... </option>
                    @isset($departments)
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label for="services">Services</label>
            <select name="services[]" id="services" class="form-control" multiple="multiple">
                @isset($services)
                @foreach ($services as $service)
                @if (!isset($service->parent_id))
                <option value="{{$service->id}}"
                    {{isset($package->services) ? (in_array($service->id,$package->services->pluck('id')->toArray()) ? 'selected' : '') : ''}}>
                    {{$service->name}}</option>
                @isset($service->children)
                @foreach ($service->children as $child)
                <option value="{{$child->id}}"
                    {{isset($package->services) ? (in_array($child->id,$package->services->pluck('id')->toArray()) ? 'selected' : '') : ''}}>
                    --> {{$child->name . '( ' . $child->parent->name . ' )'}}</option>
                @endforeach
                @endisset
                @endif
                @endforeach
                @endisset
            </select>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$package ?? null" name="Package" />