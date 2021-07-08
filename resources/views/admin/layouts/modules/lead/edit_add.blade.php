<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{$lead->name ?? old('name')}}" placeholder="Lead Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="name">Description</label>
                            <textarea name="description" id="heavytexteditor" cols="30" rows="10">
                                @isset($lead->description)
                                    {!! $lead->description !!}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
                <x-adminetic-edit-add-button :model="$lead ?? null" name="Lead" />
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <div class="input-group">
                                <button class="btn btn-outline-primary p-2" type="button" id="code_reload"><i
                                        class="fa fa-refresh"></i></button>
                                <input name="code" type="number" class="form-control" id="code"
                                    value="{{$lead->code ?? old('code')}}" placeholder="Code">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="input-group">
                                <select name="status" id="status" class="select2">
                                    <option selected disabled>Select Status ... </option>
                                    <option value="1"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 1 ? "selected" : "") : ""}}>
                                        New
                                    </option>
                                    <option value="2"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 2 ? "selected" : "") : ""}}>
                                        Qualified
                                    </option>
                                    <option value="3"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 3 ? "selected" : "") : ""}}>
                                        Unqualified
                                    </option>
                                    <option value="4"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 4 ? "selected" : "") : ""}}>
                                        Discussion
                                    </option>
                                    <option value="5"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 5 ? "selected" : "") : ""}}>
                                        Negotiation
                                    </option>
                                    <option value="6"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 6 ? "selected" : "") : ""}}>
                                        Won
                                    </option>
                                    <option value="7"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 7 ? "selected" : "") : ""}}>
                                        Lost
                                    </option>
                                    <option value="8"
                                        {{isset($lead) ? ($lead->getRawOriginal('status') == 8 ? "selected" : "") : ""}}>
                                        Follow Up
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="contact_date">Contact Date</label>
                            <div class="input-group">
                                <input type="text" name="contact_date" id="contact_date" class="form-control"
                                    value="{{$lead->contact_date ?? old('contact_date')}}" placeholder="Contact Date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="lead_by">Lead By</label>
                            <div class="input-group">
                                <select name="lead_by" id="lead_by" class="select2">
                                    <option selected disabled>Lead By ... </option>
                                    @isset($users)
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}"
                                        {{isset($lead->lead_by) ? ($lead->lead_by == $user->id ? 'selected' : '') : ''}}>
                                        {{$user->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="lead_by">Assigned To</label>
                            <div class="input-group">
                                <select name="assigned_to" id="assigned_to" class="select2">
                                    <option selected disabled>Assigned To ... </option>
                                    @isset($users)
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}"
                                        {{isset($lead->assigned_to) ? ($lead->assigned_to == $user->id ? 'selected' : '') : ''}}>
                                        {{$user->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="contact_id">Contact</label>
                            @livewire('admin.contact.select-contact', ['contact_id' => $lead->contact_id ?? null])
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="source_id">Source</label>
                            <div class="input-group">
                                <select name="source_id" id="source_id" class="select2">
                                    <option selected disabled>Select Source ... </option>
                                    @isset($sources)
                                    @foreach ($sources as $source)
                                    <option value="{{$source->id}}"
                                        {{isset($lead->source_id) ? ($lead->source_id == $source->id ? 'selected' : '') : ''}}>
                                        {{$source->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="service_id">Service</label>
                            <div class="input-group">
                                <select name="service_id" id="service_id" class="select2">
                                    <option selected disabled>Select Service ... </option>
                                    @isset($services)
                                    @foreach ($services as $service)
                                    @if (!isset($service->parent_id))
                                    <option value="{{$service->id}}"
                                        {{isset($lead->service_id) ? ($lead->service_id == $service->id ? 'selected' : '') : ''}}>
                                        {{$service->name}}</option>
                                    @isset($service->children)
                                    @foreach ($service->children as $children)
                                    <option value="{{$children->id}}">--> {{$children->name}}</option>
                                    @endforeach
                                    @endisset
                                    @endif
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>