@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Client Project Invoice</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ adminRedirectRoute('client') }}">Clients</a>
                    </li>
                    <li class="breadcrumb-item active">Client Project Invoice</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="Payment Invoice" route="payment">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('client') }}" class="btn btn-primary btn-air-primary mx-1">Back</a>
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
                                                                    {{$client->name ?? 'N/A'}}
                                                                </h4>
                                                                <p>
                                                                    @isset($client->email)
                                                                    {{$client->email}}<br>
                                                                    @endisset
                                                                    @isset($client->phone)
                                                                    <span>{{$client->phone}}</span>
                                                                    @endisset
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-md-end text-xs-center">
                                                            <h3>Invoice #<span
                                                                    class="counter">{{rand(100000,999999)}}</span>
                                                            </h3>
                                                            <p>Issued:
                                                                {{\Carbon\Carbon::now()->toFormattedDateString()}}<br>
                                                                Issued By: {{auth()->user->name ?? 'N/A'}}
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
                                                    <td class="item">
                                                        <h6 class="p-2 mb-0">Project</h6>
                                                    </td>
                                                    <td class="item">
                                                        <h6 class="p-2 mb-0">Price</h6>
                                                    </td>
                                                    <td class="item">
                                                        <h6 class="p-2 mb-0">Fine</h6>
                                                    </td>
                                                    <td class="item">
                                                        <h6 class="p-2 mb-0">Grand Total</h6>
                                                    </td>
                                                    <td class="item">
                                                        <h6 class="p-2 mb-0">Paid Amount</h6>
                                                    </td>
                                                    <td class="Hours">
                                                        <h6 class="p-2 mb-0">Remaining Amount</h6>
                                                    </td>
                                                </tr>
                                                @foreach ($projects as $project)
                                                <tr>
                                                    <td>{{isset($project->name) ? \Illuminate\Support\Str::limit($project->name,30) : ('#'.$project->code)}}
                                                    </td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . $project->valid_price}}
                                                    </td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . ($project->fine ?? 0)}}
                                                    </td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . ($project->grand_total ?? 0)}}
                                                    </td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . ($project->paid_amount ?? 0)}}
                                                    </td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . ($project->remaining_amount ?? 0)}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Total Remaining Amount</h6>
                                                    </td>
                                                    <td class="payment">
                                                        <h6 class="mb-0 p-2">
                                                            {{config('adminetic.currency_symbol','Rs.') . ($remaining_amount ?? 0)}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="Rate">
                                                        <h6 class="mb-0 p-2">Total Paid Amount</h6>
                                                    </td>
                                                    <td class="payment">
                                                        <h6 class="mb-0 p-2 text-danger">
                                                            {{config('adminetic.currency_symbol','Rs.') . $projects->sum('paid_amount')}}
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
                                                            {{config('adminetic.currency_symbol','Rs.') . $projects->sum('fine')}}
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
                                                            {{config('adminetic.currency_symbol','Rs.') . ($grand_total ?? 0)}}
                                                        </h6>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <!-- End Table-->
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
@include('admin.layouts.modules.payment.scripts')
@endsection