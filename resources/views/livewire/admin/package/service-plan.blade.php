<div>
    <hr>
    <div class="row">
        <input type="hidden" name="services[{{$selected_service->id}}][id]" value="{{$selected_service->id}}">
        <div class="col-lg-3"><b>{{$selected_service->name}}</b></div>
        <div class="col-lg-3"><b>{{$selected_service->type}}</b></div>
        <div class="col-lg-3"><input type="number" wire:model="unit" name="services[{{$selected_service->id}}][unit]"
                class="form-control" value="{{$unit}}">
        </div>
        <div class="col-lg-3"><input type="number" wire:model="price" name="services[{{$selected_service->id}}][price]"
                class="form-control" value="{{$price}}">
        </div>
    </div>
    <hr>
</div>