<div>
    <span wire:click="$emitUp('active_toggle',{{ $contact->id }})"
        class="badge badge-{{ $contact->active ? 'primary' : 'danger' }} badge-air-{{ $active ? 'primary' : 'danger' }}"
        style="cursor: pointer">{{ $active ? 'Active' : 'Inactive' }}</span>
</div>
