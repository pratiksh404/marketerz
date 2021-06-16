<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg" id="campaign_info_card" style="display:none">
            <div class="card-header">
                <h4 class="card-title">Campaign Information</h4>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3" style="position: static;">
                            <label for="name">Campaign Name</label>
                            <input name="name" class="form-control btn-square" id="name" type="text"
                                placeholder="Campaign Name" data-bs-original-title="Campaign Name"
                                title="Campaign Name">
                        </div>
                        <div class="mb-3" style="position: static;">
                            <label for="description">Campaign Description</label>
                            <input name="description" class="form-control btn-square" id="description" type="text"
                                placeholder="Campaign Description" data-bs-original-title="Campaign Description"
                                title="Campaign Description">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title">Message/Notification</h4>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <select name="template" id="template" class="select2">
                    </select>
                </div>
                <textarea name="body" id="body" class="form-control body" cols="30"
                    rows="10">@isset($template->body){!! $template->body !!}@endisset</textarea>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title">Contacts</h4>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                @livewire('admin.campaign.contacts')
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="media mb-2">
                            <label class="col-form-label m-r-10">Add Campaign Info</label>
                            <div class="media-body text-end icon-state">
                                <label class="switch">
                                    <input type="checkbox" value="1" id="campaign_info"
                                        {{ isset($campaign->name) || isset($campaign->description) ? 'checked' : '' }}><span
                                        class="switch-state"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="col-form-label m-r-10">Campaign Channel</label>
                            <select name="channel" id="channel" class="select2">
                                <option selected disabled>Select Channel ... </option>
                                <option value="1"
                                    {{ isset($campaign->channel) ? ($campaign->getRawOriginal('channel') == 1 ? 'selected' : '') : '' }}>
                                    Email</option>
                                <option value="2"
                                    {{ isset($campaign->channel) ? ($campaign->getRawOriginal('channel') == 2 ? 'selected' : '') : '' }}>
                                    SMS</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-title">Cost Evaluation</h4>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3" style="position: static;">
                    <label for="unit_cost">Unit Cost</label>
                    <input name="unit_cost" class="form-control btn-square touchspin" id="unit_cost" type="number"
                        placeholder="Unit Cost" data-bs-original-title="Unit Cost" title="Unit Cost"
                        value="{{ $campaign->unit_cost ?? (old('unit_cost') ?? 1) }}">
                </div>
                <div class="mb-3" style="position: static;">
                    <label for="estimated_cost">Estimated Cost</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                        <input name="estimated_price" type="number" class="form-control" value="0" id="estimated_cost"
                            disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <select name="send_type" id="send_type" class="form-control">
                                <option value="1">Send Now</option>
                                <option value="2">Schedule Campaign</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" id="scheduled_time" name="scheduled_time" value=""
                                style="display: none">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" value="{{isset($campaign) ? "Edit Campaign" : "Create Campaign"}}"
                            class="btn btn-{{isset($campaign) ? "warning" : "primary"}} btn-air-{{isset($campaign) ? "warning" : "primary"}} btn-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>