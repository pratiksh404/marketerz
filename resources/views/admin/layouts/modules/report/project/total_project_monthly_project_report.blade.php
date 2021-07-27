@if(isset($monthly_project_report))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Month</th>
            <th>Total Projects</th>
            <th>Total Price</th>
            <th>Total Discounted Price</th>
            <th>Total Paid Amount</th>
            <th>Total Fine</th>
            <th>Total Return</th>
            <th>Total Remaining Amount</th>
            <th>Grand Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($monthly_project_report as $month => $month_project_report)
        <tr>
            <td>{{$month}}</td>
            <td>{{$month_project_report['total_project_count']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_project_report['total_price']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_project_report['total_discounted_price']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_project_report['total_paid_amount']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_project_report['fine']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_project_report['total_return']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_project_report['total_remaining_amount']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_project_report['total_grand_total']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h4 class="text-center">Monthly Project Report Not Found</h4>
@endif