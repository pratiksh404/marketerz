@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Categories</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ adminRedirectRoute('advance') }}">Advances</a>
                    </li>
                    <li class="breadcrumb-item active">Advance Invoice</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="Advance Invoice" route="advance">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('advance') }}" class="btn btn-primary btn-air-primary mx-1">Back</a>
    </x-slot>
    <x-slot name="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice">
                            <div id="invoice-print">
                                <div>
                                    <div class="row">
                                        <table class="table">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="d-flex justify-content-center">
                                                        <div id="company">
                                                            <img class="media-object img-100" src="{{getLogo()}}"
                                                                alt="{{setting('title',env('APP_NAME','Marketerz'))}}"><br>
                                                            <b>{{setting('title','Techcoderz Nepal')}}</b><br>
                                                            <b>{{setting('address','Baneshwor, Kathmandu')}}</b><br>
                                                            <b>{{setting('phone','+977 984-3276470')}}</b><br>
                                                            <b>{{setting('email','info@techcoderznepal.com')}}</b><br>
                                                            <b>{{setting('website','techcoderznepal.com')}}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <div class="media-body m-l-20">
                                                                <h4 class="media-heading">
                                                                    {{$advance->client->name ?? 'N/A'}}
                                                                </h4>
                                                                <p>
                                                                    @isset($advance->client->email)
                                                                    {{$advance->client->email}}<br>
                                                                    @endisset
                                                                    @isset($payemnt->client->phone)
                                                                    <span>{{$advance->client->phone}}</span>
                                                                    @endisset
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-md-end float-right">
                                                            <h3>Invoice #<span
                                                                    class="counter">{{$advance->code ?? rand(100000,999999)}}</span>
                                                            </h3>
                                                            <p>Issued:
                                                                {{$advance->updated_at->toFormattedDateString()}}<br>
                                                                Issued By: {{$payemnt->user->name ?? 'N/A'}}
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <div class="table-responsive invoice-table" id="table">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Advanc Amount</h6>
                                                    </td>
                                                    <td class="advance">
                                                        <h6 class="mb-0 p-2">
                                                            {{config('adminetic.currency_symbol','Rs.') . $advance->amount}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Credit</h6>
                                                    </td>
                                                    <td class="advance">
                                                        <h6 class="mb-0 p-2 text-success">
                                                            {{config('adminetic.currency_symbol','Rs.') . $advance->client->credit}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Debit</h6>
                                                    </td>
                                                    <td class="advance">
                                                        <h6 class="mb-0 p-2 text-danger">
                                                            {{config('adminetic.currency_symbol','Rs.') . $advance->client->debit}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <!-- End Table-->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div>
                                                <h6>Payment Method</h6>
                                                <p>{{$advance->payment_method}}</p>
                                                <br>
                                                <p class="legal"><strong>Thank you for your business!</strong></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End InvoiceBot-->
                            </div>
                            <div class="col-sm-12 text-center mt-3">
                                <button class="btn btn btn-primary me-2" type="button"
                                    id="print-invoice-button">Print</button>
                            </div>
                            <!-- End Invoice-->
                            <!-- End Invoice Holder-->
                            <!-- Container-fluid Ends-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('admin.layouts.modules.advance.scripts')
@endsection