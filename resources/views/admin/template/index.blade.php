@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-index-page name="template" route="template">
        <x-slot name="content">
            {{-- ================================Card================================ --}}
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($templates as $template)
                        <tr>
                            <td>{{ $template->code }}</td>
                            <td>{{ $template->name }}</td>
                            <td><span
                                    class="badge badge-pi;; badge-{{ $template->type == 'SMS' ? 'info' : 'warning' }}"></span>{{ $template->type }}
                            </td>
                            <td>
                                <x-adminetic-action :model="$template" route="template" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-index-page>
@endsection

@section('custom_js')
    @include('admin.layouts.modules.template.scripts')
@endsection
