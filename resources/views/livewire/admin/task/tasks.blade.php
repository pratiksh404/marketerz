<div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="email-app-sidebar left-bookmark task-sidebar">
                        <div class="media">
                            <div class="media-size-email"><img class="img-70 rounded-circle"
                                    src="{{getProfilePlaceholder()}}" alt="{{auth()->user()->name}}"></div>
                            <div class="d-flex justify-content-end">
                                <div>
                                    <h6 class="f-w-600">{{auth()->user()->name}}</h6>
                                    <p>{{auth()->user()->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @if (isset($tasks))
            @if ($tasks->count() > 0)
            @foreach ($tasks as $task)
            <div class="card shadow-lg">
                <div class="card-body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. In, tenetur.</div>
            </div>
            @endforeach
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