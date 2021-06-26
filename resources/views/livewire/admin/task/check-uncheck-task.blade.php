<div>
    @isset($status)
    <button
        class="btn btn-pill btn-outline-{{$status ? 'warning' : 'success'}} btn-air-{{$status ? 'warning' : 'success'}} btn-xs mt-2"
        type="button" wire:key="check{{$task->id}}"
        wire:click="$emitUp('change_status')">{{$status ? "Uncheck" : "Check"}}</button>
    @endisset
</div>