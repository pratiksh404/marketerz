@if(isset($yearly_payment_report))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Year</th>
            <th>Total Projects</th>
            <th>Total Clients</th>
            <th>Total Payment Methods</th>
            <th>Total Payments</th>
            <th>Total Payment Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($yearly_payment_report as $year => $month_payment_report)
        <tr>
            <td>{{$year}}</td>
            <td>{{$month_payment_report['total_project_count']}}</td>
            <td>{{$month_payment_report['total_client_count']}}</td>
            <td>{{$month_payment_report['total_payment_method_count']}}</td>
            <td>{{$month_payment_report['total_payment_count']}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . $month_payment_report['total_payment']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h4 class="text-center">Yearly Payment Report Not Found</h4>
@endif