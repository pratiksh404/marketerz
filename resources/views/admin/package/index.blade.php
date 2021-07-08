@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="package" route="package">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discounted Price</th>
                    <th>Department</th>
                    <th>Interval</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                <tr>
                    <td>{{$package->name}}</td>
                    <td>{{config('adminetic.currency_symbol','Rs.') . $package->price}}</td>
                    <td>{{config('adminetic.currency_symbol','Rs.') . ($package->discounted_price ?? 0)}}</td>
                    <td>{{$package->department->name ?? 'N/A'}}</td>
                    <td>{{$package->interval ?? 'N/A'}} days</td>
                    <td>
                        <x-adminetic-action :model="$package" route="package" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discounted Price</th>
                    <th>Department</th>
                    <th>Interval</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.package.scripts')
@endsection