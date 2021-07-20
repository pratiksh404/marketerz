@isset($client->projects)
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Total :</td>
            <td><b>{{ config('adminetic.currency_symbol','Rs.') . Marketerz::totalClientPayments($client)}}</b></td>
        </tr>
    </tbody>
</table>
<br>
<table class="table table-striped table-bordered datatable" style="width: 100%:overflow-x:auto">
    <thead>
        <tr>
            <th>Project</th>
            <th>Registered By</th>
            <th>Payment</th>
            <th>Method</th>
            <th>Registered Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($client->projects as $project)
        @isset($project->payments)
        @foreach ($project->payments as $payment)
        <tr>
            <td><a
                    href="{{adminShowRoute('project',$payment->project->id)}}">{{$payment->project->name ?? ('#' . $payment->project->code)}}</a>
            </td>
            <td>{{$payment->user->name}}</td>
            <td>{{ config('adminetic.currency_symbol','Rs.') . $payment->payment}}</td>
            <td><span class="badge badge-{{$payment->getPaymentMethodColor()}}">{{$payment->payment_method}}</span>
            </td>
            <td>{{$payment->updated_at->toFormattedDateString()}}</td>
            <td>
                <x-adminetic-action :model="$payment" route="payment" show="0"
                    delete="$payment->project->remaining_amount == 0 ? 0 : 1" />
            </td>
        </tr>
        @endforeach
        @endisset
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Project</th>
            <th>Registered By</th>
            <th>Payment</th>
            <th>Method</th>
            <th>Registered Date</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<br>
<div id="daily_client_payment" data-client_id="{{$client->id}}"></div>
<div id="monthly_client_payment" data-client_id="{{$client->id}}"></div>
@endisset