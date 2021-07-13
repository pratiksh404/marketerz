<div>
    @isset($services)
    @if ($services->count() > 0)
    <div class="row">
        @foreach ($services->chunk(6) as $group)
        <div class="col-lg-6">
            @foreach ($group as $service)
            <input type="checkbox" wire:model="checkedservices.{{$service->id}}" class="checkbox_animated"
                value="{{$service->id}}" wire:key="checkedservice{{$service->id}}"
                value="{{isset($model->services) ? (in_array($service->id,$model->services->pluck('id')->toArray()) ? 'selected' : '') : ''}}">{{$service->name}}
            <br>
            @endforeach
        </div>
        @endforeach
    </div>
    @endif
    @endisset
    @isset($selected_services)
    @if ($selected_services->count() > 0)
    <div class="row">
        <div class="col-lg-3"><b>Name</b></div>
        <div class="col-lg-3"><b>Plan</b></div>
        <div class="col-lg-3"><b>Unit</b></div>
        <div class="col-lg-3"><b>Price</b></div>
    </div>
    @foreach ($selected_services as $selected_service)
    @livewire('admin.package.service-plan', ['selected_service' => $selected_service],
    key('service'.$selected_service->id . now()))
    @endforeach
    @endif
    @endisset
</div>