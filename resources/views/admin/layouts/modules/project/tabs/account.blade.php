<div class="card shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <b>Client Name : </b> <span class="text-muted">{{$project->client->name}}</span>
                <br>
                <b>Client Address : </b> <span class="text-muted">{{$project->client->address ?? 'N/A'}}</span>
                <br>
                <b>Client Credit : </b> <span
                    class="text-muted">{{config('adminetic.currency_symbol','Rs.') . $project->client->credit ?? 'N/A'}}</span>
            </div>
            <div class="col-lg-6">
                <b>Client Phone : </b> <span class="text-muted">{{$project->client->phone ?? 'N/A'}}</span>
                <br>
                <b>Client Email : </b> <span class="text-muted">{{$project->client->email ?? 'N/A'}}</span>
                <br>
                <b>Client Debit : </b> <span
                    class="text-muted">{{config('adminetic.currency_symbol','Rs.') . $project->client->debit ?? 'N/A'}}</span>
            </div>
        </div>
    </div>
</div>
@if($project->cancel)
<div class="alert alert-danger inverse alert-dismissible fade show" role="alert"><i class="icon-thumb-down"></i>
    <p>This project was cancelled on {{\Carbon\Carbon::create($project->cancel_date)->toFormattedDateString()}}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Return Amount</h5>
                        <p>
                            {{config('adminetic.currency_symbol','Rs.').$project->return}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="default-according" id="accordionclose">
    <div class="card">
        <div class="card-header" id="heading1">
            <h5 class="mb-0">
                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true"
                    aria-controls="heading1">
                    Return Remark (Click to open ...)
                </button>
            </h5>
        </div>
        <div class="collapse" id="collapse1" aria-labelledby="heading1" data-bs-parent="#accordionclose">
            <div class="card-body">
                @if (isset($project->return_remark))
                {!! $project->return_remark !!}
                @else
                <span class="text-muted">No Return Remark Registered.</span>
                @endif
            </div>
        </div>
    </div>
</div>
<br>
@endif
<div class="row">
    <div class="col-xl-3 xl-50 col-sm-4">
        <div class="card bg-success">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Paid Amount</h5>
                        <p>
                            {{config('adminetic.currency_symbol','Rs.').$project->paid_amount}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 xl-50 col-sm-4">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Remaining Amount</h5>
                        <p>
                            {{config('adminetic.currency_symbol','Rs.').$project->remaining_amount}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Price</th>
            <th>Discounted Price</th>
            <th>Fine</th>
            <th>Grand Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->price ?? 'N/A')}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->discounted_price ?? 'N/A')}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->fine ?? 'N/A')}}</td>
            <td>{{config('adminetic.currency_symbol','Rs.') . ($project->grand_total ?? 'N/A')}}</td>
        </tr>
    </tbody>
</table>
@isset($project->payments)
<hr>
<table class="table table-striped table-bordered datatable">
    <thead>
        <tr>
            <th>Project</th>
            <th>Registered By</th>
            <th>Payment</th>
            <th>Method</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($project->payments as $payment)
        <tr>
            <td><a
                    href="{{adminShowRoute('project',$payment->project->id)}}">{{$payment->project->name ?? ('#' . $payment->project->code)}}</a>
            </td>
            <td>{{$payment->user->name}}</td>
            <td>{{ config('adminetic.currency_symbol','Rs.') . $payment->payment}}</td>
            <td><span class="badge badge-{{$payment->getPaymentMethodColor()}}">{{$payment->payment_method}}</span>
            </td>
            <td>
                <x-adminetic-action :model="$payment" route="payment" show="0"
                    delete="$payment->project->remaining_amount == 0 ? 0 : 1" />
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Project</th>
            <th>Registered By</th>
            <th>Payment</th>
            <th>Method</th>
            <th>Actions</th>
        </tr>
    </tfoot>
</table>
@endisset