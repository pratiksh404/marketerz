@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="service" route="service">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Plan</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ config('adminetic.currency_symbol','Rs.') . ($service->price ?? 0)}}</td>
                    <td>{{$service->type}}</td>
                    <td><span
                            class="badge badge-{{ $service->active ? 'success' : 'danger' }}">{{ $service->active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td>
                        <x-adminetic-action :model="$service" route="service" show="0" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Plan</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.service.scripts')
@endsection