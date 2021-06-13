@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Campaigns</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Campaigns</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.modules.campaign.chart_widget')
<x-adminetic-card name="campaign" title="All Campaigns">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('campaign')}}" class="btn btn-primary btn-air-primary">Create Campaign</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>Channel</th>
                    <th>Contacts</th>
                    <th>Campaign By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campaigns as $campaign)
                <tr>
                    <td>{{$campaign->code}}</td>
                    <td><span
                            class="badge badge-{{$campaign->getRawOriginal('channel') == 1 ? 'primary' : 'warning'}}">{{$campaign->channel}}</span>
                    </td>
                    <td>{{count($campaign->contacts)}}</td>
                    <td>{{$campaign->campaigner->name ?? 'N/A'}}</td>
                    <td>
                        <x-adminetic-action :model="$campaign" route="campaign" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>CODE</th>
                    <th>Channel</th>
                    <th>Contacts</th>
                    <th>Campaign By</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('admin.layouts.modules.campaign.chart_scripts')
@endsection