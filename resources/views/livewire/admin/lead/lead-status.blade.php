<div>
    @if (isset($lead))
    <div class="btn-group mx-1" role="group">
        <button class="btn btn-sm btn-{{$lead->getStatusColor()}} btn-air-{{$lead->getStatusColor()}} dropdown-toggle"
            type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            data-bs-original-title="Lead Status" title="Lead Status"
            {{$converted_to_client ? 'disabled' : ''}}>{{$lead->getStatus()}}</button>
        <div class="dropdown-menu" aria-labelledby="leadStatus"
            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
            data-popper-placement="bottom-start">
            <button class="dropdown-item" wire:click="$emitUp('status_changed',1, {{$lead->id}})"
                style="cursor: pointer">New</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',2, {{$lead->id}})"
                style="cursor: pointer">Qualified</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',3, {{$lead->id}})"
                style="cursor: pointer">Unqualified</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',4, {{$lead->id}})"
                style="cursor: pointer">Discussion</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',5, {{$lead->id}})"
                style="cursor: pointer">Negotiation</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',6, {{$lead->id}})"
                style="cursor: pointer">Won</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',7, {{$lead->id}})"
                style="cursor: pointer">Lost</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',8, {{$lead->id}})"
                style="cursor: pointer">Follow
                Up</button>
        </div>
    </div>
    @endif
</div>