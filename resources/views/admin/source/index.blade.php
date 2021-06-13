@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-index-page name="source" route="source">
        <x-slot name="content">
            {{-- ================================Card================================ --}}
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sources as $source)
                        <tr>
                            <td>{{ $source->id }}</td>
                            <td>{{ $source->name }}</td>
                            <td>
                                <x-adminetic-action :model="$source" route="source" show="0" />
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
    @include('admin.layouts.modules.source.scripts')
@endsection
