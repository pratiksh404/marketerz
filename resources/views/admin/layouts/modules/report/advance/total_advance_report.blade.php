@if($advance_report)
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Subject</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Clients</td>
            <td>{{$advance_report['total_client_count'] ?? 0}}</td>
        </tr>
        <tr>
            <td>Total Payment Methods</td>
            <td>{{$advance_report['total_payment_method_count'] ?? 0}}</td>
        </tr>
        <tr>
            <td>Total Advances</td>
            <td>{{$advance_report['total_advance_count'] ?? 0}}</td>
        </tr>
        <tr>
            <td>Total Advance Amount</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($advance_report['total_advance'] ?? 0)}}</td>
        </tr>
    </tbody>
</table>
@else
<h4 class="text-center">Advance Report Not Found</h4>
@endif