@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="discussion" route="discussion">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Lead</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discussions as $discussion)
                <tr>
                    <td><a href="{{adminShowRoute('lead',$discussion->lead->id)}}">{{$discussion->lead->code}}</a>
                    </td>
                    <td><span class="badge badge-{{$discussion->getTypeColor()}}">{{$discussion->type}}</span></td>
                    <td><span class="badge badge-{{$discussion->getStatusColor()}}">{{$discussion->getStatus()}}</span>
                    </td>
                    <td>{{$discussion->user->name ?? 'N/A'}}</td>
                    <td>{{\Carbon\Carbon::create($discussion->discussion_date)->toFormattedDateString()}}</td>
                    <td>
                        <x-adminetic-action :model="$discussion" route="discussion" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Lead</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.discussion.scripts')
@endsection