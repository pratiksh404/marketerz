<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <button wire:click="all_processes" class="btn btn-warning btn-air-warning">All
                            Processess</button>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-info btn-air-info dropdown-toggle" id="channelFilter" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="Channel Filter" title="Channel Filter"><i
                                    class="fa fa-filter"></i></button>
                            <div class="dropdown-menu" aria-labelledby="channelFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                <button class="dropdown-item" wire:click="email_process">Email</button>
                                <button class="dropdown-item" wire:click="sms_process">SMS</button>
                            </div>
                        </div>
                        <div class="btn-group mx-1" role="group">
                            <button class="btn btn-primary btn-air-primary dropdown-toggle" id="statusFilter"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-bs-original-title="Status Filter" title="Status Filter"><i
                                    class="fa fa-flask"></i></button>
                            <div class="dropdown-menu" aria-labelledby="statusFilter"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);"
                                data-popper-placement="bottom-start">
                                <button class="dropdown-item" wire:click="processing_process">Processing</button>
                                <button class="dropdown-item" wire:click="success_process">Success</button>
                                <button class="dropdown-item" wire:click="failed_process">Failed</button>
                                <button class="dropdown-item" wire:click="retry_process">Retry</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-hover">
                        <tr>
                            <th>ID</th>
                            <th>UUID</th>
                            <th>Channel</th>
                            <th>Campaign</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                        </tr>
                        <tbody>
                            @isset($processes)
                            @foreach ($processes as $process)
                            <tr>
                                <td>{{$process->id}}</td>
                                <td>{{$process->uuid}}</td>
                                <td><span
                                        class="badge badge-{{$process->color($process->getRawOriginal('channel'))}}">{{$process->channel}}</span>
                                </td>
                                <td>{{$process->campaign->code ?? 'N/A'}}</td>
                                <td>{{$process->contact->name ?? 'N/A'}}</td>
                                <td><span
                                        class="badge badge-{{$process->color($process->getRawOriginal('status'))}}">{{$process->status}}</span>
                                </td>
                                <td>{{$process->updated_at->toDateTimeString()}}</td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$processes->links()}}
                </div>
            </div>
        </div>
    </div>
</div>