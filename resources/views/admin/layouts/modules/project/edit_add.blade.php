<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="name">Project Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{$project->name ?? old('name')}}" placeholder="Project Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="heavytexteditor" cols="30" rows="10">
                                @isset($project->description)
                                    {!! $project->description !!}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>