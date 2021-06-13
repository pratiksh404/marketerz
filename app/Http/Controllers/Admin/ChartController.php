<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Marketerz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     *
     * Daily SMS Email Count
     *
     */
    public function get_daily_sms_email_count()
    {
        return response()->json(['sms_email_count' => Marketerz::dailyEmailsSMS()], 200);
    }
    /**
     *
     * Get Daily SMS Count
     *
     */
    public function get_daily_sms_count()
    {
        return response()->json(['sms_count' => Marketerz::dailySMS()], 200);
    }
    /**
     *
     * Get Daily Email Count
     *
     */
    public function get_daily_email_count()
    {
        return response()->json(['email_count' => Marketerz::dailyEmails()], 200);
    }
}
