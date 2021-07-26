@if($payment_report)
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Subject</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Projects</td>
            <td>{{$payment_report['total_project_count'] ?? 0}}</td>
        </tr>
        <tr>
            <td>Total Clients</td>
            <td>{{$payment_report['total_client_count'] ?? 0}}</td>
        </tr>
        <tr>
            <td>Total Payment Methods</td>
            <td>{{$payment_report['total_payment_method_count'] ?? 0}}</td>
        </tr>
        <tr>
            <td>Total Payments</td>
            <td>{{$payment_report['total_payment_count'] ?? 0}}</td>
        </tr>
        <tr>
            <td>Total Payment Amount</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($payment_report['total_payment'] ?? 0)}}</td>
        </tr>
    </tbody>
</table>
@else
<h4 class="text-center">Payment Report Not Found</h4>
@endif