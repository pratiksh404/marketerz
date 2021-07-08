<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label for="lead_id">Lead <a href="{{adminCreateRoute('lead')}}">Create Lead ?</a></label>
            <div class="input-group">
                <select name="lead_id" id="lead_id" class="select2" style="width: 100%">
                    <option selected disabled>Select Lead ... </option>
                    @isset($leads)
                    @foreach ($leads as $lead)
                    <option value="{{$lead->id}}"
                        {{isset($lead->lead_id) ? ($lead->lead_id == $lead->id ? 'selected' : '') : ''}}>
                        {{'code : ' . $lead->code . ' | Name : ' . ($lead->name ?? 'N/A') . ' | Contact : ' . ($lead->contact->name ?? 'N/A') . ' | Service : ' . ($lead->service->name ?? 'N/A')}}
                    </option>
                    @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="subject">Subject</label>
            <div class="input-group">
                <input type="text" name="subject" id="subject" class="form-control"
                    value="{{$discussion->subject ?? old('subject')}}" placeholder="Subject">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="type">Discussion Type</label>
            <div class="input-group">
                <select name="type" id="type" class="select2" style="width: 100%">
                    <option selected disabled>Select Discussion Type ... </option>
                    <option value="1">Feedback</option>
                    <option value="2">Request</option>
                    <option value="3">Demand</option>
                    <option value="4">Complain</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="type">Discussion Type</label>
            <div class="input-group">
                <select name="status" id="status" class="select2">
                    <option selected disabled>Select Status ... </option>
                    <option value="1"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 1 ? "selected" : "") : ""}}>
                        New
                    </option>
                    <option value="2"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 2 ? "selected" : "") : ""}}>
                        Qualified
                    </option>
                    <option value="3"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 3 ? "selected" : "") : ""}}>
                        Unqualified
                    </option>
                    <option value="4"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 4 ? "selected" : "") : ""}}>
                        Discussion
                    </option>
                    <option value="5"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 5 ? "selected" : "") : ""}}>
                        Negotiation
                    </option>
                    <option value="6"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 6 ? "selected" : "") : ""}}>
                        Won
                    </option>
                    <option value="7"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 7 ? "selected" : "") : ""}}>
                        Lost
                    </option>
                    <option value="8"
                        {{isset($discussion) ? ($discussion->getRawOriginal('status') == 8 ? "selected" : "") : ""}}>
                        Follow Up
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-3">
        <div class="mb-3">
            <label for="discussion_date">Discussion Date</label>
            <div class="input-group">
                <input type="text" name="discussion_date" id="discussion_date" class="form-control"
                    value="{{$lead->discussion_date ?? old('discussion_date')}}" placeholder="Discussion Date">
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row">
            <div class="mb-3 mt-4 col-md-12">
                <div class="d-flex date-details">
                    <div class="d-inline-block">
                        <label class="d-block mb-0" for="chk-ani">
                            <input type="hidden" name="reminder" value="0">
                            <input name="reminder" class="checkbox_animated" id="chk-ani" type="checkbox" value="1"
                                {{isset($discussion->reminder) ? ($discussion->reminder ? 'checked' : '') : ''}}>Remind
                            on
                        </label>
                        @error('reminder')
                        <p class="help-block text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="d-inline-block">
                        <input name="reminder_datetime" class="reminder_datetime form-control" id="reminder_datetime"
                            type="text" data-language="en" placeholder="Date"
                            value="{{$discussion->reminder_datetime ?? old('reminder_datetime')}}" disabled>
                        @error('reminder_datetime')
                        <p class="help-block text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani1" type="checkbox" value="1"
                            {{isset($discussion->channel) ? (in_array(1,$discussion->channel) ? 'checked' : '') : ''}}
                            disabled>Mail
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani2" type="checkbox" value="2"
                            {{isset($discussion->channel) ? (in_array(2,$discussion->channel) ? 'checked' : '') : ''}}
                            disabled>SMS
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani3" type="checkbox" value="3"
                            {{isset($discussion->channel) ? (in_array(3,$discussion->channel) ? 'checked' : '') : ''}}
                            disabled>Slack
                    </div>
                    <div class="d-inline-block">
                        <input name="channel[]" class="checkbox_animated" id="chk-ani4" type="checkbox" value="4"
                            {{isset($discussion->channel) ? (in_array(4,$discussion->channel) ? 'checked' : '') : ''}}
                            disabled>System
                    </div>
                    @error('channel')
                    <p class="help-block text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="discussion">Discussion</label>
        <textarea name="discussion" id="heavytexteditor" cols="30" rows="10" class="heavytexteditor">
            @isset($discussion->discussion)
                {!! $discussion->discussion !!}
            @endisset
        </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$discussion ?? null" name="Discussion" />