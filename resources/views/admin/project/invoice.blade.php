@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Project Invoice</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ adminRedirectRoute('project') }}">Projects</a>
                    </li>
                    <li class="breadcrumb-item active">Project Invoice</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="project Invoice" route="project">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('project') }}" class="btn btn-primary btn-air-primary mx-1">Back</a>
    </x-slot>
    <x-slot name="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice">
                            <div id="invoice-print">
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
                                <div>
                                    <div class="row">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            <div class="media-body m-l-20">
                                                                <h4 class="media-heading">
                                                                    {{$project->client->name ?? 'N/A'}}
                                                                </h4>
                                                                <p>
                                                                    @isset($project->client->email)
                                                                    {{$project->client->email}}<br>
                                                                    @endisset
                                                                    @isset($payemnt->project->client->phone)
                                                                    <span>{{$project->client->phone}}</span>
                                                                    @endisset
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-md-end text-xs-center">
                                                            <h3>Invoice #<span
                                                                    class="counter">{{$project->code ?? rand(100000,999999)}}</span>
                                                            </h3>
                                                            <p>Issued:
                                                                {{\Carbon\Carbon::now()->toFormattedDateString()}}<br>
                                                                Issued By: {{auth()->user()->name ?? 'N/A'}}
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
                                    <div class="d-flex justify-content-center">
                                        <h4><b>{{$project->name ?? ('#' . $project->code)}}</b></h4>
                                    </div>
                                    <div class="invoice-table" id="table">
                                        @isset($project->payments)
                                        @if ($project->payments->count() > 0)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-responsive invoice-table" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>Code</th>
                                                            <th>Payment</th>
                                                            <th>Method</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($project->payments as $payment)
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>#{{$payment->code}}</td>
                                                            <td>{{ config('adminetic.currency_symbol','Rs.') . $payment->payment}}
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-{{$payment->getPaymentMethodColor()}}">{{$payment->payment_method}}</span>
                                                            </td>
                                                            <td>{{$payment->updated_at->toDayDateTimeString()}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                        @endisset
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Price</h6>
                                                    </td>
                                                    <td class="project">
                                                        <h6 class="mb-0 p-2">
                                                            {{config('adminetic.currency_symbol','Rs.') . $project->valid_price}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Remaining Amount</h6>
                                                    </td>
                                                    <td class="project">
                                                        <h6 class="mb-0 p-2 text-danger">
                                                            {{config('adminetic.currency_symbol','Rs.') . $project->remaining_amount}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Paid Amount</h6>
                                                    </td>
                                                    <td class="project">
                                                        <h6 class="mb-0 p-2 text-success">
                                                            {{config('adminetic.currency_symbol','Rs.') . $project->paid_amount}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Fine</h6>
                                                    </td>
                                                    <td class="project">
                                                        <h6 class="mb-0 p-2 text-warning">
                                                            {{config('adminetic.currency_symbol','Rs.') . $project->fine}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Grand Total</h6>
                                                    </td>
                                                    <td class="project">
                                                        <h6 class="mb-0 p-2 text-success">
                                                            {{config('adminetic.currency_symbol','Rs.') . $project->grand_total}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- End Table-->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div>
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
@include('admin.layouts.modules.project.scripts')
@endsection