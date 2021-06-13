<div class="row">
    <div class="col-lg-6">
        <label for="name">Template Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{ $template->name ?? old('name') }}"
                placeholder="Template Name">
        </div>
    </div>
    <div class="col-lg-4">
        <label for="type">Template Type</label>
        <div class="input-group">
            <select name="type" id="type" class="select2" style="width: 100%">
                <option selected disabled>Select Template Type ... </option>
                <option value="1" {{ isset($template) ? ($template->type == 'Email' ? 'selected' : '') : '' }}>
                    Email
                </option>
                <option value="2" {{ isset($template) ? ($template->type == 'SMS' ? 'selected' : '') : '' }}>SMS
                </option>
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <label for="active">Active ?</label> <br>
        <input type="hidden" name="active" value="0">
        <input type="checkbox" name="active" class="switch" id="active" value="1"
            {{ isset($template) ? ($template->active ? 'checked' : '') : 'checked' }} />
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between">
            <label for="message">Message</label>
            <span class="float-right">
                <button class="btn btn-primary btn-air-primary" type="button" data-bs-toggle="modal"
                    data-original-title="test" data-bs-target="#templateTags">Tags</button>
            </span>
        </div>
        <textarea name="message" class="form-control message" cols="30"
            rows="10">@isset($template->message){!! $template->message !!}@endisset</textarea>
    </div>
    <hr>
    <x-adminetic-edit-add-button :model="$template ?? null" name="Template" />
</div>


{{-- Modal --}}
<div class="modal fade" id="templateTags" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Available Tags</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tag</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($template_tags)
                        @foreach ($template_tags as $tag)
                        <tr>
                            <td>{{ $tag['name'] ?? 'N/A' }}</td>
                            <td>{{ $tag['tag'] ?? 'N/A' }}</td>
                            <td>{{ $tag['description'] ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>