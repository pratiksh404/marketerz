<div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <span>Progress</span> ( <span class="text-success">{{$total_success_jobs ?? 0}}</span> / <span
                        class="text-danger">{{$total_failed_jobs ?? 0}}</span> )
                    <br>
                    <div class="progress sm-progress-bar">
                        <div class="progress-bar bg-primary" role="progressbar"
                            style="width: {{$success_percent ?? 0}}%" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="card card-shadow">
                <div class="card-body">
                    <button class="btn btn-block btn-primary btn-air-primary"
                        wire:click="$emitUp('retry_all_failed_jobs')">Retry All</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="card-body" style="overflow-x:auto">
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>UUID</th>
                                <th>Connection</th>
                                <th>Queue</th>
                                <th>Display Name</th>
                                <th>Failed At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($failed_jobs)
                            @foreach ($failed_jobs as $failed_job)
                            @php
                            $payload = json_decode($failed_job->payload);
                            @endphp
                            <tr wire:key="{{$failed_job->uuid}}">
                                <td>{{$failed_job->id}}</td>
                                <td>{{$failed_job->uuid}}</td>
                                <td>{{$failed_job->connection}}</td>
                                <td>{{$failed_job->queue}}</td>
                                <td>{{$payload->displayName}}</td>
                                <td>{{$failed_job->failed_at}}</td>
                                <td>
                                    <button wire:click="$emitUp('retry_job','{{$failed_job->uuid}}')"
                                        wire:key="retry{{$failed_job->uuid}}"
                                        class="btn btn-sm btn-warning btn-air-warning" title="Retry"><i
                                            class="fa fa-refresh"></i></button>
                                    <button class="btn btn-sm btn-info btn-air-info" title="Show"><i
                                            class="fa fa-eye"></i></button>
                                    <button class="btn btn-sm btn-danger btn-air-danger" title="Delete"
                                        wire:key="delete{{$failed_job->uuid}}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>