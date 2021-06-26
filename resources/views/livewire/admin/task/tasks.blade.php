<div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row media">
                        <div class="col-lg-5">
                            <div class="media-size-email"><img class="img-70 rounded-circle"
                                    src="{{getProfilePlaceholder()}}" alt="{{auth()->user()->name}}"></div>
                        </div>
                        <div class="col-lg-7">
                            <div class="m-2">
                                <h6 class="f-w-600">{{auth()->user()->name}}</h6>
                                <p>{{auth()->user()->email}}</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary btn-air-primary btn-block" type="button" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-lg">Create Task</button>
                    </div>
                    <hr>
                    <div wire:click="allTasks" class="text-center" style="cursor: pointer;">All Task</div>
                    <br>
                    <div wire:click="todayTasks" class="text-center" style="cursor: pointer;">Today's Task</div>
                    <br>
                    <div wire:click="delayedTasks" class="text-center" style="cursor: pointer;">Delayed Task</div>
                    <br>
                    <div wire:click="upcomingTasks" class="text-center" style="cursor: pointer;">Upcoming Task</div>
                    <br>
                    <div wire:click="weekTasks" class="text-center" style="cursor: pointer;">This Week Task</div>
                    <br>
                    <div wire:click="monthTasks" class="text-center" style="cursor: pointer;">This Month Task</div>
                    <br>
                    <div wire:click="assignedTo" class="text-center" style="cursor: pointer;">Assigned To Me</div>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-9" wire:init="loadTask">
            <div wire:ignore wire:loading.flex>
                <div style="width:100%;align-items: center;justify-content: center;">
                    <div class="loader-box" style="margin:auto">
                        <div class="loader-2"></div>
                    </div>
                </div>
            </div>
            <div wire:loading.remove>
                @if (isset($tasks))
                @if ($tasks->count() > 0)
                <div class="default-according" id="accordionclose">
                    @foreach ($tasks as $task)
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h5 class="mb-0" id="heading{{$task->id}}">
                                        <button class=" btn btn-link {{$loop->first ? '' : 'collapsed'}}"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{$task->id}}"
                                            aria-expanded="{{$loop->first}}" aria-controls="heading{{$task->id}}">
                                            @if ($task->status)
                                            <del>{{$task->task}}</del>
                                            @else
                                            {{$task->task}}
                                            @endif
                                        </button>
                                    </h5>
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex justify-content-around">
                                        @livewire('admin.task.check-uncheck-task', ['task' => $task], key($task->id))
                                        <button wire:click="$emitUp('delete_task',{{$task->id}})"
                                            wire:key="delete{{$task->id}}"
                                            class="btn btn-pill btn-outline-danger btn-air-danger btn-xs mt-2"
                                            type="button">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="collapse{{$task->id}}" aria-labelledby="heading{{$task->id}}"
                            data-bs-parent="#accordionclose">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <b>Deadline : </b> <span
                                                    class="text-muted text-danger">{{\Carbon\Carbon::create($task->deadline)->toFormattedDateString()}}</span>

                                                <hr>
                                                <b>Reminder : </b> <span
                                                    class="badge badge-{{$task->reminder ? 'success' : 'danger'}}">{{$task->reminder ? "ON" : "OFF"}}</span>

                                                <hr>
                                                <b>Reminder Date Time : </b> <span
                                                    class="text-muted">{{\Carbon\Carbon::create($task->reminder_date_time)->toFormattedDateString()}}</span>

                                                <hr>
                                                <b>Channel : </b> @foreach ($task->channel as $channel)
                                                <span class="badge badge-primary">{{$task->getChannel($channel)}}</span>
                                                @endforeach
                                                <hr>
                                                @if (isset($task->assigned_to))
                                                <b>Assigned To : </b> <span
                                                    class="badge badge-primary">{{$task->assignedTo->name ?? 'N/A'}}</span>
                                                <hr>
                                                <b>Assigned By : </b> <span
                                                    class="badge badge-primary">{{$task->user->name ?? 'N/A'}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <h4><b class="text-center">Description</b></h4>
                                        <hr>
                                        <p>
                                            {{$task->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr>
                {{$tasks->links()}}
                @else
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="text-center">No Tasks</h4>
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    {{-- MODAL --}}
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="create_task" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Create Task</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="submit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <input type="text" wire:model.defer="task" id="task" class="form-control"
                                        placeholder="Task">
                                    @error('task')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-1">
                                @error('color')
                                <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <input wire:model.defer="deadline" wire:ignore.self class="deadline form-control"
                                    id="deadline" type="text" data-language="en" placeholder="Deadline"
                                    onchange="this.dispatchEvent(new InputEvent('input'))">
                                @error('deadline')
                                <p class="help-block text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <textarea wire:model.defer="description" id="decsription" class="form-control"
                                        cols="15" rows="5"></textarea>
                                    @error('description')
                                    <p class="help-block text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="mb-3 mt-0 col-md-12">
                                        <div class="d-flex date-details">
                                            <div class="d-inline-block">
                                                <label class="d-block mb-0" for="chk-ani">
                                                    <input wire:model="reminder" class="checkbox_animated" id="chk-ani"
                                                        type="checkbox">Remind on
                                                </label>
                                                @error('reminder')
                                                <p class="help-block text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="d-inline-block">
                                                <input wire:model.defer="reminder_date_time"
                                                    class="reminder_date_time form-control" id="reminder_date_time"
                                                    type="text" data-language="en" placeholder="Date"
                                                    onchange="this.dispatchEvent(new InputEvent('input'))"
                                                    {{$reminder == 1 ? "" : "disabled"}}>
                                                @error('reminder_date_time')
                                                <p class="help-block text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="d-inline-block">
                                                <label class="d-block mb-0" for="chk-ani1">
                                                    <input wire:model.defer="channel" value="1"
                                                        class="checkbox_animated" id="chk-ani1" type="checkbox"
                                                        {{$reminder == 1 ? "" : "disabled"}}>Mail
                                                </label>
                                            </div>
                                            <div class="d-inline-block">
                                                <label class="d-block mb-0" for="chk-ani2">
                                                    <input wire:model.defer="channel" value="2"
                                                        class="checkbox_animated" id="chk-ani2" type="checkbox"
                                                        {{$reminder == 1 ? "" : "disabled"}}>SMS
                                                </label>
                                            </div>
                                            <div class="d-inline-block">
                                                <label class="d-block mb-0" for="chk-ani3">
                                                    <input wire:model.defer="channel" value="3"
                                                        class="checkbox_animated" id="chk-ani3" type="checkbox"
                                                        {{$reminder == 1 ? "" : "disabled"}}>Slack
                                                </label>
                                            </div>
                                            <div class="d-inline-block">
                                                <label class="d-block mb-0" for="chk-ani4">
                                                    <input wire:model.defer="channel" value="4"
                                                        class="checkbox_animated" id="chk-ani4" type="checkbox"
                                                        checked="checked" {{$reminder == 1 ? "" : "disabled"}}>System
                                                    Notification
                                                </label>
                                            </div>
                                            @error('channel')
                                            <p class="help-block text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <select wire:model="assigned_to" id="assigned_to" class="form-control"
                                        style="width:100%">
                                        <option value="">Assign Task To ... </option>
                                        @isset($users)
                                        @foreach ($users as $user)
                                        @if ($user->id !- auth()->user()->id)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                        @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-air-primary float-right">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('livewire_third_party')
    <script>
        $(function() {
            initializeTask();
        window.livewire.on('taskCreated', () => $('#create_task').modal('toggle'));
        livewire.on('initializeTask',function(){
            initializeTask();
        });
        function initializeTask()
        {
            $('#deadline').daterangepicker({
            parentEl: "#create_task .modal-body",
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });
        $('#reminder_date_time').daterangepicker({
            parentEl: "#create_task .modal-body",
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });
        }
              Livewire.on('taskCreated', function() {
                    var notify_allow_dismiss = Boolean(
                        {{ config('adminetic.notify_allow_dismiss', true) }});
                    var notify_delay = {{ config('adminetic.notify_delay', 2000) }};
                    var notify_showProgressbar = Boolean(
                        {{ config('adminetic.notify_showProgressbar', true) }});
                    var notify_timer = {{ config('adminetic.notify_timer', 300) }};
                    var notify_newest_on_top = Boolean(
                        {{ config('adminetic.notify_newest_on_top', true) }});
                    var notify_mouse_over = Boolean(
                        {{ config('adminetic.notify_mouse_over', true) }});
                    var notify_spacing = {{ config('adminetic.notify_spacing', 1) }};
                    var notify_notify_animate_in =
                        "{{ config('adminetic.notify_animate_in', 'animated fadeInDown') }}";
                    var notify_notify_animate_out =
                        "{{ config('adminetic.notify_animate_out', 'animated fadeOutUp') }}";
                    var notify = $.notify({
                        title: "<i class='{{ config('adminetic.notify_icon', 'fa fa-bell-o') }}'></i> " +
                            "Success",
                        message: "Task Created !"
                    }, {
                        type: 'success',
                        allow_dismiss: notify_allow_dismiss,
                        delay: notify_delay,
                        showProgressbar: notify_showProgressbar,
                        timer: notify_timer,
                        newest_on_top: notify_newest_on_top,
                        mouse_over: notify_mouse_over,
                        spacing: notify_spacing,
                        animate: {
                            enter: notify_notify_animate_in,
                            exit: notify_notify_animate_out
                        }
                    });
                });
         Livewire.on('task_deleted', function() {
               var notify_allow_dismiss = Boolean(
                   {{ config('adminetic.notify_allow_dismiss', true) }});
               var notify_delay = {{ config('adminetic.notify_delay', 2000) }};
               var notify_showProgressbar = Boolean(
                   {{ config('adminetic.notify_showProgressbar', true) }});
               var notify_timer = {{ config('adminetic.notify_timer', 300) }};
               var notify_newest_on_top = Boolean(
                   {{ config('adminetic.notify_newest_on_top', true) }});
               var notify_mouse_over = Boolean(
                   {{ config('adminetic.notify_mouse_over', true) }});
               var notify_spacing = {{ config('adminetic.notify_spacing', 1) }};
               var notify_notify_animate_in =
                   "{{ config('adminetic.notify_animate_in', 'animated fadeInDown') }}";
               var notify_notify_animate_out =
                   "{{ config('adminetic.notify_animate_out', 'animated fadeOutUp') }}";
               var notify = $.notify({
                   title: "<i class='{{ config('adminetic.notify_icon', 'fa fa-bell-o') }}'></i> " +
                       "Success",
                   message: "Task Deleted !"
               }, {
                   type: 'danger',
                   allow_dismiss: notify_allow_dismiss,
                   delay: notify_delay,
                   showProgressbar: notify_showProgressbar,
                   timer: notify_timer,
                   newest_on_top: notify_newest_on_top,
                   mouse_over: notify_mouse_over,
                   spacing: notify_spacing,
                   animate: {
                       enter: notify_notify_animate_in,
                       exit: notify_notify_animate_out
                   }
               });
           });
    });
    </script>
    @endpush
</div>