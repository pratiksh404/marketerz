<div>
    <div class="row" style="overflow-x:auto">
        <div class="col-lg-12">
            <div class="mb-3 d-flex justify-content-center">
                <div class="btn-group btn-group" role="group" aria-label="Contact Filter">
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-primary dropdown-toggle" id="clients" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Client</button>
                        <div class="dropdown-menu" aria-labelledby="clients">
                            @isset($clients)
                            @foreach ($clients as $client)
                            <button type="button" wire:click="$emitUp('client_import_contacts',{{ $client->id }})"
                                class="dropdown-item">{{$client->name}}</button>
                            @endforeach
                            @endisset
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button">Custom</button>
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-primary dropdown-toggle" id="groups" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Group</button>
                        <div class="dropdown-menu" aria-labelledby="groups">
                            @isset($groups)
                            @foreach ($groups as $group)
                            <button type="button" wire:click="$emitUp('group_import_contacts',{{ $group->id }})"
                                class="dropdown-item">{{$group->name}}</button>
                            @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div wire:ignore wire:loading.flex>
                <div style="width:100%;align-items: center;justify-content: center;">
                    <div class="loader-box" style="margin:auto">
                        <div class="loader-2"></div>
                    </div>
                </div>
            </div>
            <div wire:loading.remove>
                <div class="mb-3" wire:init="loadContacts" style="max-height:30vh;overflow:auto">
                    <table class="table table-bordered contact_table"
                        data-contact_count="{{isset($contacts) ? $contacts->count() : 0}}">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Sex</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($contacts)
                            @foreach ($contacts as $contact)
                            <tr>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{$contact->email}}</td>
                                <td>
                                    <i
                                        class="fa fa-{{$contact->gender == 1 ? 'male' : ($contact->gender == 2 ? 'female' : 'minus')}} text-{{$contact->gender == 1 ? 'primary' : ($contact->gender == 2 ? 'danger' : 'warning')}}"></i>
                                </td>
                                <td>
                                    <input name="contacts[]" class="form-check-input contact_check_box"
                                        id="{{'contact' . $contact->id}}" type="checkbox" value="{{$contact->id}}"
                                        checked>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Hidden Input --}}
    <input type="hidden" name="client_id" value={{$client_id ?? null}}>
    <input type="hidden" name="group_id" value={{$group_id ?? null}}>
    @push('livewire_third_party')
    <script>
        $(function(){

    Livewire.on('initialize_load_contacts', function() {
            initializeContacts();
        });

function initializeContacts()
{
   
        getContactCount();

        $('#unit_cost').on('change',function(){
         getContactCount();
        });

        $(':checkbox').on('change',function(){
            getContactCount();
        });


}

function getContactCount()
{
    var contact_count = checkedCount($('.contact_table'),'.contact_check_box');
    var unit_cost = $('#unit_cost').val();
    var estimated_cost = parseFloat(contact_count.checked) * parseFloat(unit_cost);
    $('#estimated_cost').val(estimated_cost);
}

function checkedCount($table, checkboxClass) {
  if ($table) {
    // Find all elements with given class
    var chkAll = $table.find(checkboxClass);
    // Count checked checkboxes
    var checked = chkAll.filter(':checked').length;
    // Count total
    var total = chkAll.length;    
    // Return an object with total and checked values
    return {
      total: total,
      checked: checked
    }
  }
}
    });
    </script>
    @endpush
</div>