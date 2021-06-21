<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Process;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function failed_jobs()
    {
        return view('admin.job.failed_jobs');
    }

    public function show_failed_job($uuid)
    {
        $job = DB::table('failed_jobs')->where('uuid', $uuid)->first();
        $process = Process::where('uuid', $uuid)->first();
        return view('admin.job.show_failed_job', compact('job', 'process'));
    }

    public function processes()
    {
        return view('admin.job.processes');
    }
}
