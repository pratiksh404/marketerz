@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="department" route="department">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                <tr>
                    <td>{{$department->name}}</td>
                    <td><span
                            class="badge badge-{{$department->active ? 'success' : 'danger'}}">{{$department->active ? 'Active' : 'Deactive'}}</span>
                    </td>
                    <td>
                        <x-adminetic-action :model="$department" route="department" show="0" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.department.scripts')
@endsection