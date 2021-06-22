@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="client" route="client">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->address }}</td>
                    <td>
                        <x-adminetic-action :model="$client" route="client">
                            <x-slot name="buttons">
                                <button class="btn btn-success btn-air-success" type="button" data-bs-toggle="modal"
                                    data-bs-target=".import-client-contacts{{$client->id}}"
                                    title="Import Client Contact"><i class="fa fa-mail-reply-all"></i></button>
                            </x-slot>
                        </x-adminetic-action>
                    </td>
                </tr>

                {{-- Import Modal --}}
                <div class="modal fade import-client-contacts{{$client->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Import Contacts</h4>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('import_client_contacts',['client' => $client->id]) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex justify-content-between">
                                        <input type="file" name="contacts_import" id="contacts_import"
                                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <a href="{{ asset('adminetic/static/contacts.xlsx') }}"
                                            class="btn btn-primary btn-air-primary">Download Sample</a>
                                    </div>
                                    <br><br>
                                    <input type="submit" value="Import" class="btn btn-primary btn-air-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.client.scripts')
@endsection