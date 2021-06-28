<div class="row">
    <div class="col-lg-8">
        <div class="mb-3">
            <input type="text" name="task" id="task" class="form-control" placeholder="Task"
                value="{{$task->task ?? old('task')}}">
            @error('task')
            <p class="help-block text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <input name="deadline_date_time" class="deadline form-control" id="deadline_date_time" type="text"
            data-language="en" placeholder="Date" value="{{$task->deadline ?? old('deadline')}}">
        @error('deadline')
        <p class="help-block text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <textarea name="description" id="decsription" class="form-control" cols="15"
                rows="5">{{$task->description ?? old('description')}}</textarea>
            @error('description')
            <p class="help-block text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>
    {{-- Hidden Input --}}
    <input type="hidden" name="status" value="0">
    <div class="col-lg-12">
        <div class="row">
            <div class="mb-3 mt-0 col-md-12">
                <div class="d-flex date-details">
                    <div class="d-inline-block">
                        <label class="d-block mb-0" for="chk-ani">
                            <input type="hidden" name="reminder" value="0">
                            <input name="reminder" class="checkbox_animated" id="chk-ani" type="checkbox" value="1"
                                {{isset($task->reminder) ? ($task->reminder ? 'checked' : '') : ''}}>Remind
                            on
                        </label>
                        @error('reminder')
                        <p class="help-block text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="d-inline-block">
                        <input name="reminder_date_time" class="reminder_date_time form-control" id="reminder_date_time"
                            type="text" data-language="en" placeholder="Date"
                            value="{{$task->reminder_date_time ?? old('reminder_date_time')}}" disabled>
                        @error('reminder_date_time')
                        <p class="help-block text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani1" type="checkbox" value="1"
                            {{isset($task->channel) ? (in_array(1,$task->channel) ? 'checked' : '') : ''}} disabled>Mail
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani2" type="checkbox" value="2"
                            {{isset($task->channel) ? (in_array(2,$task->channel) ? 'checked' : '') : ''}} disabled>SMS
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani3" type="checkbox" value="3"
                            {{isset($task->channel) ? (in_array(3,$task->channel) ? 'checked' : '') : ''}}
                            disabled>Slack
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani4" type="checkbox" value="4"
                            {{isset($task->channel) ? (in_array(4,$task->channel) ? 'checked' : '') : ''}}
                            disabled>System
                    </div>
                    @error('channel')
                    <p class="help-block text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <select name="assigned_to" id="assigned_to" class="form-control" style="width:100%">
                <option value="">Assign Task To ... </option>
                @isset($users)
                @foreach ($users as $user)
                @if ($user->id != auth()->user()->id)
                <option value="{{$user->id}}"
                    {{isset($task->assigned_to) ? ($task->assigned_to == $user->id ? 'selected' : '') : ''}}>
                    {{$user->name}}</option>
                @endif
                @endforeach
                @endisset
            </select>
        </div>
    </div>
    <x-adminetic-edit-add-button :model="$task ?? null" name="Task"></x-adminetic-edit-add-button>
</div>