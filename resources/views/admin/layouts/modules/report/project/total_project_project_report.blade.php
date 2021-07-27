@if($project_report)
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
            <td>{{($project_report['total_project_count'] ?? 0)}}</td>
        </tr>
        <tr>
            <td>Total Price</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($project_report['total_price'] ?? 0)}}</td>
        </tr>
        <tr>
            <td>Total Discounted Price</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($project_report['total_discounted_price'] ?? 0)}}</td>
        </tr>
        <tr>
            <td>Total Paid Amount</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($project_report['total_paid_amount'] ?? 0)}}</td>
        </tr>
        <tr>
            <td>Total Fine</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($project_report['fine'] ?? 0)}}</td>
        </tr>
        <tr>
            <td>Total Return</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($project_report['total_return'] ?? 0)}}</td>
        </tr>
        <tr>
            <td>Total Remaining Amount</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($project_report['total_remaining_amount'] ?? 0)}}</td>
        </tr>
        <tr>
            <td>Grand Total</td>
            <td>{{config('adminetic.currency_symbol','Rs') . ($project_report['total_grand_total'] ?? 0)}}</td>
        </tr>
    </tbody>
</table>
@else
<h4 class="text-center">Project Report Not Found</h4>
@endif