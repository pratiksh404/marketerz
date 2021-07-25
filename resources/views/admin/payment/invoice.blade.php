@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Payment Invoice</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ adminRedirectRoute('payment') }}">Payments</a>
                    </li>
                    <li class="breadcrumb-item active">Payment Invoice</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="Payment Invoice" route="payment">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('payment') }}" class="btn btn-primary btn-air-primary mx-1">Back</a>
    </x-slot>
    <x-slot name="content">
        <div class="card">
            <div class="card-body">
                <div id="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card bg-primary">
                                <div class="card-body">
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
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        {{$payment->project->client->name ?? 'N/A'}}
                                                    </h4>
                                                    <p>
                                                        @isset($payment->project->client->email)
                                                        {{$payment->project->client->email}}<br>
                                                        @endisset
                                                        @isset($payment->project->client->phone)
                                                        <span>{{$payment->project->client->phone}}</span>
                                                        @endisset
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-md-end">
                                                <h3>Invoice
                                                    #<span>{{$payment->code ?? rand(100000,999999)}}</span>
                                                </h3>
                                                <br>
                                                Issued:
                                                {{$payment->updated_at->toFormattedDateString()}}<br>
                                                Issued By: {{$payemnt->user->name ?? 'N/A'}}
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
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td class="item">
                                            <h6 class="p-2 mb-0">Service</h6>
                                        </td>
                                        <td class="Hours">
                                            <h6 class="p-2 mb-0">Initial Paid Amount</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if (isset($payment->project_id))
                                        <td>
                                            <b>{{$payment->project->name ?? ('#'.$payment->project->code)}}(Project)</b>
                                        </td>
                                        @elseif(isset($payment->campaign))
                                        @endif
                                        <td>
                                            <p class="itemtext">
                                                {{config('adminetic.currency_symbol','Rs.') . $payment->payment}}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="Rate">
                                            <h6 class="mb-0 p-2">Total</h6>
                                        </td>
                                        <td class="payment">
                                            <h6 class="mb-0 p-2">
                                                {{config('adminetic.currency_symbol','Rs.') . $payment->payment}}
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="Rate">
                                            <h6 class="mb-0 p-2">Remaining Amount</h6>
                                        </td>
                                        <td class="payment">
                                            <h6 class="mb-0 p-2 text-danger">
                                                {{config('adminetic.currency_symbol','Rs.') . $payment->project->remaining_amount}}
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="Rate">
                                            <h6 class="mb-0 p-2">Paid Amount</h6>
                                        </td>
                                        <td class="payment">
                                            <h6 class="mb-0 p-2 text-success">
                                                {{config('adminetic.currency_symbol','Rs.') . $payment->project->paid_amount}}
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="Rate">
                                            <h6 class="mb-0 p-2">Fine</h6>
                                        </td>
                                        <td class="payment">
                                            <h6 class="mb-0 p-2 text-warning">
                                                {{config('adminetic.currency_symbol','Rs.') . $payment->project->fine}}
                                            </h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="Rate">
                                            <h6 class="mb-0 p-2">Grand Total</h6>
                                        </td>
                                        <td class="payment">
                                            <h6 class="mb-0 p-2 text-success">
                                                {{config('adminetic.currency_symbol','Rs.') . $payment->project->grand_total}}
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
                                    <p>{{$payment->payment_method}}</p>
                                    <br>
                                    <p class="legal"><strong>Thank you for your business!</strong></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-center mt-3">
                    <button class="btn btn btn-primary me-2" type="button" id="print-invoice-button">Print</button>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('admin.layouts.modules.payment.scripts')
@endsection