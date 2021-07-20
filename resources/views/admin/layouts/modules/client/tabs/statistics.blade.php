<ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
    <li class="nav-item"><a class="nav-link active" id="info-project-tab" data-bs-toggle="tab" href="#info-project"
            role="tab" aria-controls="info-project" aria-selected="true"><i
                class="icofont icofont-ui-project"></i>Project</a></li>
    <li class="nav-item"><a class="nav-link" id="marketing-info-tab" data-bs-toggle="tab" href="#info-marketing"
            role="tab" aria-controls="info-marketing" aria-selected="false"><i
                class="icofont icofont-man-in-glasses"></i>Marketing</a>
    </li>
</ul>
<div class="tab-content" id="info-tabContent">
    <div class="tab-pane fade show active" id="info-project" role="tabpanel" aria-labelledby="info-project-tab">
        @include('admin.layouts.modules.client.tabs.stats.project_stats')
    </div>
    <div class="tab-pane fade" id="info-marketing" role="tabpanel" aria-labelledby="marketing-info-tab">
        @include('admin.layouts.modules.client.tabs.stats.marketing_stats')
    </div>
</div>