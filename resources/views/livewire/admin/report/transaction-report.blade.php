<div>
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="input-group">
                    <span class="input-group-text">Date Range</span>
                    <input type="text" id="reportdaterangepicker" class="from-control">
                </div>
                <div class="input-group">
                    <select id="clientid" wire:ignore>
                        <option value="">Select Client</option>
                        @isset($clients)
                        @foreach ($clients as $client)
                        <option value="{{$client->id}}"
                            {{isset($clientid) ? ($clientid == $client->id ? 'selected' : '') : ''}}>
                            {{$client->name}}</option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                <button type="button" class="btn btn-primary btn-air-primary btn-sm p-2"
                    id="print-report-button">Print</button>
            </div>
        </div>
    </div>
    <div class="card shadow-lg">
        <div class="card-body">
            <div id="report-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <div id="company">
                                <img class="media-object img-100" src="{{getLogo()}}"
                                    alt="{{setting('title',env('APP_NAME','Marketerz'))}}"><br>
                                <b>{{setting('title','Techcoderz Nepal')}}</b><br>
                                <b>{{setting('address','Baneshwor, Kathmandu')}}</b><br>
                                <b>{{setting('phone','+977 984-3276470')}}</b><br>
                                <b>{{setting('email','info@techcoderznepal.com')}}</b><br>
                                <b>{{setting('website','techcoderznepal.com')}}</b>
                            </div>
                            <div id="report-description">
                                <br><br>
                                @isset($clientid)
                                @php
                                $client = App\Models\Admin\Client::find($clientid);
                                @endphp
                                <b>Client : </b> <span class="text-muted">{{$client->name}}</span> <br>
                                <b>Phone : </b> <span class="text-muted">{{$client->phone ?? 'N/A'}}</span> <br>
                                @endisset
                                <h4 class="text-bold">Transaction Report</h4>
                                <br>
                                <h6 class="text-muted">{{$startdate}} - {{$enddate}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div wire:loading.remove>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Advance</th>
                                <th>Total</th>
                                <th>Payments</th>
                                <th>Total</th>
                                <th>Returns</th>
                                <th>Total</th>
                                <th>Expense</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($transactions)
                            @foreach ($transactions as $date => $transaction)
                            <tr>
                                <td>{{$date}}</td>
                                <td>
                                    @if(count($transaction['advances']) > 0)
                                    <div class="advances" style="-webkit-transform: scale(0.67);
                                                                                        -moz-transform: scale(0.67);
                                                                                         transform: scale(0.67);">

                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Client</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaction['advances'] as $advance)
                                                <tr>
                                                    <td>{{$advance->client->name}}</td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . $advance->amount}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    {{config('adminetic.currency_symbol','Rs.') . ($transaction['advance_total'] ?? 0)}}
                                </td>
                                <td>
                                    @if(count($transaction['payments']) > 0)
                                    <div class="payments" style="-webkit-transform: scale(0.67);
                                                                                        -moz-transform: scale(0.67);
                                                                                         transform: scale(0.67);">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Client</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaction['payments'] as $payment)
                                                <tr>
                                                    <td>{{$payment->client->name}}</td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . $payment->payment}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    {{config('adminetic.currency_symbol','Rs.') . ($transaction['payment_total'] ?? 0)}}
                                </td>
                                <td>
                                    @if(count($transaction['returns']) > 0)
                                    <div class="returns" style="-webkit-transform: scale(0.67);
                                                                                        -moz-transform: scale(0.67);
                                                                                         transform: scale(0.67);">

                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Client</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaction['returns'] as $return)
                                                <tr>
                                                    <td>{{$return->client->name}}</td>
                                                    <td>{{config('adminetic.currency_symbol','Rs.') . $return->return}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    {{config('adminetic.currency_symbol','Rs.') . ($transaction['return_total'] ?? 0)}}
                                </td>
                                <td>
                                    {{config('adminetic.currency_symbol','Rs.') . ($transaction['expense_total'] ?? 0)}}
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table-bordered">
                            <tbody>
                                <tr>
                                    <td>Advance Total : </td>
                                    <td> {{config('adminetic.currency_symbol','Rs.') . ($total['advances_total'] ?? 0)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payment Total : </td>
                                    <td> {{config('adminetic.currency_symbol','Rs.') . ($total['payments_total'] ?? 0)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Return Total : </td>
                                    <td> {{config('adminetic.currency_symbol','Rs.') . ($total['returns_total'] ?? 0)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Expenses Total : </td>
                                    <td> {{config('adminetic.currency_symbol','Rs.') . ($total['expenses_total'] ?? 0)}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div wire:ignore wire:loading.flex>
                        <div style="width:100%;align-items: center;justify-content: center;">
                            <div class="loader-box" style="margin:auto">
                                <div class="loader-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function(){
                    initializeProjectReport();
                    Livewire.on('transaction_report_generated',function(){
                        initializeProjectReport();
                    });
                    function initializeProjectReport()
                    {
                        $('#reportdaterangepicker').daterangepicker();
        
                        $('#reportdaterangepicker').on('apply.daterangepicker',function(ev, picker){
                           let start_date = picker.startDate.format('YYYY-MM-DD');
                            let end_date = picker.endDate.format('YYYY-MM-DD');
                            window.livewire.emit('transaction_report_range_date',start_date,end_date);
                        });
        
                        $('#clientid').select2();
        
                        $('#clientid').on('change', function (e) {
                        @this.set('clientid', $(this).val());
                        });
                    }
                    });
    </script>
    @endpush
</div>