@if(isset($yearly_advance_report))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Year</th>
            <th>Total Clients</th>
            <th>Total Advance Methods</th>
            <th>Total Advances</th>
            <th>Total Advance Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($yearly_advance_report as $year => $month_advance_report)
        <tr>
            <td>{{$year}}</td>
            <td>{{$month_advance_report['total_client_count']}}</td>
            <td>{{$month_advance_report['total_payment_method_count']}}</td>
            <td>{{$month_advance_report['total_advance_count']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_advance_report['total_advance']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h4 class="text-center">Yearly Advance Report Not Found</h4>
@endif