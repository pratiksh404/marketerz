<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Particular</th>
            <th>Client</th>
            <th>Registered By</th>
            <th>Advance</th>
            <th>Method</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($advances as $advance)
        <tr>
            <td>{{\Illuminate\Support\Str::limit($advance->particular,50)}}</td>
            <td><a href="{{adminShowRoute('client',$advance->client->id)}}">{{$advance->client->name}}</a>
            </td>
            <td>{{$advance->user->name}}</td>
            <td>{{ config('adminetic.currency_symbol','Rs.') . $advance->amount}}</td>
            <td><span class="badge badge-{{$advance->getPaymentMethodColor()}}">{{$advance->payment_method}}</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>