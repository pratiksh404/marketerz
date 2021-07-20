@isset($client->projects)
<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Total :</td>
            <td><b>{{ config('adminetic.currency_symbol','Rs.') . $client->projects->sum('return')}}</b>
            </td>
        </tr>
    </tbody>
</table>
<br>
<table class="table table-striped table-bordered datatable" style="width: 100%:overflow-x:auto">
    <thead>
        <tr>
            <th>Project</th>
            <th>Return Date</th>
            <th>Return Amount</th>
            <th>Registered Date</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($client->projects as $project)
        @if ($project->cancel)
        <tr>
            <td><a href="{{adminShowRoute('project',$project->id)}}">{{$project->name ?? ('#' . $project->code)}}</a>
            </td>
            <td>{{\Carbon\Carbon::create($project->cancel_date)->toFormattedDateString()}}</td>
            <td>{{ config('adminetic.currency_symbol','Rs.') . $project->return}}</td>
            <td>{{$project->updated_at->toFormattedDateString()}}</td>
            <td>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                    data-bs-target=".remark{{$project->code}}">Remark</button>
                <div class="modal fade remark{{$project->code}}" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Return Remark</h4>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if($project->return_remark)
                                {!! $project->return_remark !!}
                                @else
                                <span class="text-muted">No remark registered.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Project</th>
            <th>Return Date</th>
            <th>Return Amount</th>
            <th>Registered Date</th>
            <th>Remark</th>
        </tr>
    </tfoot>
</table>
@endisset