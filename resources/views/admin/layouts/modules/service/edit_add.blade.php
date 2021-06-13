   <div class="row">
       <div class="col-lg-5">
           <label for="parent_id">Parent</label>
           <div class="input-group">
               <select name="parent_id" id="parent_id" class="select2" style="width: 100%">
                   <option selected disabled>Select Parent Service ... </option>
                   @isset($services)
                       @foreach ($services as $select_service)
                           @if (!isset($select_service->parent_id))
                               <option value="{{ $select_service->id }}"
                                   {{ isset($service) ? ($service->parent_id == $select_service->id ? 'selected' : '') : '' }}>
                                   {{ $select_service->name }}</option>
                           @endif
                       @endforeach
                   @endisset
               </select>
           </div>
       </div>
       <div class="col-lg-5">
           <label for="name">Service Name <span class="text-danger">*</span></label>
           <div class="input-group">
               <input type="text" name="name" id="name" class="form-control"
                   value="{{ $service->name ?? old('name') }}" placeholder="Service Name">
           </div>
       </div>
       <div class="col-lg-2">
           <label for="active">Active ?</label> <br>
           <input type="hidden" name="active" value="0">
           <input type="checkbox" name="active" class="switch" id="active" value="1"
               {{ isset($service) ? ($service->active ? 'checked' : '') : 'checked' }} />
       </div>
       <x-adminetic-edit-add-button :model="$service ?? null" name="Service" />
   </div>
