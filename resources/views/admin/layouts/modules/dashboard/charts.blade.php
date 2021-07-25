<div class="col-lg-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5 class="card-title">Debit VS Credit</h5>
                </div>
                <div class="card-body">
                    <div id="debit-credit"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5 class="card-title">Weekly Payments</h5>
                </div>
                <div class="card-body">
                    <div id="week-payment"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="card shadow-lg">
        <div class="card-header">
            <h5>Payment vs Advance vs Return</h5>
        </div>
        <div class="card-body">
            <div id="column-monthly-payment-advance-return-chart"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>Date</h5>
                            <p>
                                {{\Carbon\Carbon::now()->toFormattedDateString()}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>My Tasks</h5>
                            <p>
                                {{\App\Models\Admin\Task::where('user_id',auth()->user()->id)->where('assigned_to',auth()->user()->id)->count()}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media faq-widgets">
                        <div class="media-body">
                            <h5>My Projects</h5>
                            <p>
                                {{\App\Models\Admin\Project::where('project_head',auth()->user()->id)->count()}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>