<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function payment_report()
    {
        return view('admin.report.payment_report');
    }

    public function project_report()
    {
        return view('admin.report.project_report');
    }

    public function advance_report()
    {
        return view('admin.report.advance_report');
    }
}
