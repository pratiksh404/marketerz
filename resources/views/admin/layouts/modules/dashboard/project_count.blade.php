<div class="row">
    <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Total . Projects</h5>
                        <p>
                            {{Marketerz::projectCount()['allprojectscount']}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Ongoing Projects</h5>
                        <p>
                            {{Marketerz::projectCount()['ongoingprojectscount']}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Cancelled Projects</h5>
                        <p>
                            {{Marketerz::projectCount()['cancelledProjectscount']}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12 box-col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Deadline Projects</h5>
                        <p>
                            {{Marketerz::projectCount()['deadlineprojectscount']}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12 box-col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="media faq-widgets">
                    <div class="media-body">
                        <h5>Finished Projects</h5>
                        <p>
                            {{Marketerz::projectCount()['finishedprojectscount']}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>