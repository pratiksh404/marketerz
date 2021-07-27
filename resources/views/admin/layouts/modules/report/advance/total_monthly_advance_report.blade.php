@if(isset($monthly_advance_report))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Month</th>
            <th>Total Clients</th>
            <th>Total Advance Methods</th>
            <th>Total Advances</th>
            <th>Total Advance Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($monthly_advance_report as $month => $month_advance_report)
        <tr>
            <td>{{$month}}</td>
            <td>{{$month_advance_report['total_client_count']}}</td>
            <td>{{$month_advance_report['total_payment_method_count']}}</td>
            <td>{{$month_advance_report['total_advance_count']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_advance_report['total_advance']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h4 class="text-center">Monthly Advance Report Not Found</h4>
@endif