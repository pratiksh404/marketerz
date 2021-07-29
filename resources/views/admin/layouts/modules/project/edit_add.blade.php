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
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="input-group-text">Project Interval</span>
                                <input type="text" name="project_interval" id="project_interval"
                                    class="project_interval form-control"
                                    value="{{$project->project_interval ?? old('project_interval')}}" required>
                                {{-- Hideen Input --}}
                                <input type="hidden" name="project_startdate" id="project_startdate"
                                    value="{{$project->project_startdate ?? old('project_startdate') ?? null}}">
                                <input type="hidden" name="project_deadline" id="project_deadline"
                                    value="{{$project->project_deadline ?? old('project_deadline') ?? null}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Price</th>
                            <th>Discounted Price</th>
                            <th>Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                                    <input type="number" name="price" id="price" class="form-control"
                                        value="{{$project->price ?? old('price') ?? 0}}" placeholder="Project Price">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                                    <input type="number" name="discounted_price" id="discounted_price"
                                        class="form-control"
                                        value="{{$project->discounted_price ?? old('discounted_price') ?? 0}}"
                                        placeholder="Project Discounted Price">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
                                    <input type="number" name="fine" id="fine" class="form-control"
                                        value="{{$project->fine ?? old('fine') ?? 0}}" placeholder="Fine">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- Hidden Input --}}
                <input type="hidden" name="paid_amount" value="{{$project->paid_amount ?? 0}}">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <div class="input-group">
                                <button class="btn btn-outline-primary p-2" type="button" id="code_reload"><i
                                        class="fa fa-refresh"></i></button>
                                <input name="code" type="number" class="form-control" id="code"
                                    value="{{$project->code ?? old('code')}}" placeholder="Code">
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="col-form-label pt-2">Color</label>
                            <input name="color" class="form-control form-control-color" type="color"
                                value="{{$project->color ?? old('color') ?? '#563d7c'}}">
                        </div>
                        <div class="mb-3">
                            <label for="project_head">Project Head</label>
                            <select name="project_head" id="project_head" class="select2" style="width: 100%">
                                <option selected disabled>Select Project Head .. </option>
                                @isset($users)
                                @foreach ($users as $user)
                                <option value="{{$user->id}}"
                                    {{isset($project->project_head) ? ($project->project_head == $user->id ? 'selected' : '') : ''}}>
                                    {{$user->name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="department_id">Department</label>
                            <select name="department_id" id="department_id" class="select2" style="width: 100%">
                                <option selected disabled>Select Department .. </option>
                                @isset($departments)
                                @foreach ($departments as $department)
                                <option value="{{$department->id}}"
                                    {{isset($project->department) ? ($project->department_id == $department->id ? 'selected' : '') : ''}}>
                                    {{$department->name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @livewire('admin.project.from-lead-client', ['project' => $project ?? null,'projectfrom' => isset($lead_id)
            ? 1 : (isset($project)
            ?
            ($project->lead_id ? 1
            :
            ($project->client_id
            ? 2 : null)) : null),'leadid' => $lead_id ?? $project->lead_id ?? null], key('project_from_lead_or_client'))
            <x-adminetic-edit-add-button :model="$project ?? null" name="Project" />
        </div>
    </div>