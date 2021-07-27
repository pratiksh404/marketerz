@isset($projects)
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Status</th>
            <th>Name</th>
            <th>Client</th>
            <th>Project Head</th>
            <th>Project Interval</th>
            <th>Price</th>
            <th>Fine</th>
            <th>Grand Total</th>
            <th>Paid Amount</th>
            <th>Return</th>
            <th>Remaining Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td><span class="badge badge-{{$project->getStatusColor()}}">{{$project->getStatus()}}</span></td>
            <td>
                <a
                    href="{{adminShowRoute('project',$project->id)}}">{{isset($project->name) ? (\Illuminate\Support\Str::limit($project->name,50)) : ('#'.$project->code)}}</a>
            </td>
            <td>
                @if (isset($project->client))
                <a
                    href="{{adminShowRoute('client',$project->client_id)}}">{{$project->client->name . (isset($project->client->phone))}}</a>
                @endif
            </td>
            <td>
                {{$project->projectHead->name ?? 'N/A'}}
            </td>
            <td>{{$project->project_interval}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') .($project->valid_price ?? 0)}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->fine ?? 0)}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->grand_total ?? 0)}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->paid_amount ?? 0)}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->return ?? 0)}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->remaining_amount ?? 0)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endisset