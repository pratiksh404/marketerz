@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="lead" route="lead">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="lead-info-tab" data-bs-toggle="tab" href="#info-lead"
                    role="tab" aria-controls="info-lead" aria-selected="false"><i class="fa fa-lightbulb-o"></i>Lead</a>
            </li>
            <li class="nav-item"><a class="nav-link" id="info-stats-tab" data-bs-toggle="tab" href="#info-stats"
                    role="tab" aria-controls="info-stats" aria-selected="true"><i
                        class="fa fa-signal"></i>Statistics</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-lead" role="tabpanel" aria-labelledby="lead-info-tab">
                @livewire('admin.lead.leads')
            </div>
            <div class="tab-pane fade" id="info-stats" role="tabpanel" aria-labelledby="info-stats-tab">
                @include('admin.layouts.modules.lead.stats')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.lead.scripts')
@endsection