<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Code</th>
            <th>Project</th>
            <th>Client</th>
            <th>Registered By</th>
            <th>Particular</th>
            <th>Payment Method</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        @isset($payments)
        @foreach ($payments as $payment)
        <tr>
            <td>#{{$payment->code}}</td>
            <td>
                @if (isset($payment->project))
                <a
                    href="{{adminShowRoute('project',$payment->project_id)}}">{{$payment->project->name ?? ('#'.$project->code) ?? 'N/A'}}</a>
                @endif
            </td>
            <td>
                @if (isset($payment->client))
                <a
                    href="{{adminShowRoute('client',$payment->client_id)}}">{{$payment->client->name . (isset($payment->client->phone))}}</a>
                @endif
            </td>
            <td>
                {{$payment->user->name ?? 'N/A'}}
            </td>
            <td>
                {{\Illuminate\Support\Str::limit($payment->particular,50)}}
            </td>
            <td><span class="badge badge-{{$payment->getPaymentMethodColor()}}">{{$payment->payment_method}}</span>
            </td>
            <td>{{ config('adminetic.currency_symbol','Rs.') . $payment->payment}}</td>
        </tr>
        @endforeach
        @endisset
    </tbody>
</table>