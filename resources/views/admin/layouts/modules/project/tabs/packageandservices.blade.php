@isset($project->package)
<div class="row">
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body">
                <span class="text-bold">Name : </span> <span class="text-muted">{{$project->package->name}}</span>
                <hr>
                <span class="text-bold">Price : </span> <span
                    class="text-muted">{{config('adminetic.currency_symbol','Rs.') . $project->package->price}}</span>
                <hr>
                <span class="text-bold">Discounted Price : </span> <span
                    class="text-muted">{{config('adminetic.currency_symbol','Rs.') . ($project->package->discounted_price ?? 0)}}</span>
                <hr>
                <span class="text-bold">Department : </span> <span
                    class="text-muted">{{$project->package->department->name ?? 'N/A'}}</span>
                <hr>
                <span class="text-bold">Interval : </span> <span
                    class="text-muted">{{$project->package->interval ?? 'N/A'}}
                    days</span>
                <hr>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-body">
                <span class="text-center">Package Services</span>
                <hr>
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($project->package->services)
                        @foreach ($project->package->services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->parent->name ?? 'No Parent' }}</td>
                            <td><span
                                    class="badge badge-{{ $service->active ? 'success' : 'danger' }}">{{ $service->active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <x-adminetic-action :model="$service" route="service" show="0" delete="0" />
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endisset
@isset($project->services)
<span class="text-bold">Additional Services :- </span>
<hr>
<table class="table table-striped table-bordered datatable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Plan</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($project->services as $service)
        <tr>
            <td>{{ $service->name }}</td>
            <td>{{ config('adminetic.currency_symbol','Rs.') . ($service->price ?? 0)}}</td>
            <td>{{$service->type}}</td>
            <td><span
                    class="badge badge-{{ $service->active ? 'success' : 'danger' }}">{{ $service->active ? 'Active' : 'Inactive' }}</span>
            </td>
            <td>
                <x-adminetic-action :model="$service" route="service" show="0" />
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Plan</th>
            <th>Active</th>
        </tr>
    </tfoot>
</table>
@endisset