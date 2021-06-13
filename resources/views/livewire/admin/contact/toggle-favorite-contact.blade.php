<div>
    <button wire:click="$emitUp('favorite_toggle',{{ $contact->id }})" class="btn btn-default btn-air-default"
        style="cursor: hover;">
        <h3 class="text-{{ $favorite ? 'warning' : 'default' }}"><i class="fa fa-star"></i></h3>
    </button>
</div>
