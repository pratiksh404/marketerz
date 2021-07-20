@isset($client->advances)
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Total :</td>
            <td><b>{{ config('adminetic.currency_symbol','Rs.') . $client->advances->sum('amount')}}</b></td>
        </tr>
    </tbody>
</table>
<br>
<table class="table table-striped table-bordered datatable">
    <thead>
        <tr>
            <th>Registered By</th>
            <th>Advance</th>
            <th>Method</th>
            <th>Registered Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($client->advances as $advance)
        <tr>
            <td>{{$advance->user->name}}</td>
            <td>{{ config('adminetic.currency_symbol','Rs.') . $advance->amount}}</td>
            <td><span class="badge badge-{{$advance->getPaymentMethodColor()}}">{{$advance->payment_method}}</span>
            </td>
            <td>{{$advance->updated_at->toFormattedDateString()}}</td>
            <td>
                <x-adminetic-action :model="$advance" route="advance" show="0"
                    delete="$advance->project->remaining_amount == 0 ? 0 : 1" />
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Registered By</th>
            <th>Advance</th>
            <th>Method</th>
            <th>Registered Date</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
<div id="daily_client_advance" data-client_id="{{$client->id}}"></div>
<div id="monthly_client_advance" data-client_id="{{$client->id}}"></div>
@endisset