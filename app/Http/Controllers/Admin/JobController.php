<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function failed_jobs()
    {
        return view('admin.job.failed_jobs');
    }
}
