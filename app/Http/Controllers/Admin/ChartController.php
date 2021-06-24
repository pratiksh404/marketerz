<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Marketerz;
use App\Models\Admin\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    /**
     *
     *Get Daily Client Email SMS Count
     *
     */
    public function get_client_sms_email_count(Request $request)
    {
        $client_id = $request->client_id;
        $period = $request->period ?? 7;
        if (isset($client_id)) {
            $client = Client::find($client_id);
            return response()->json(['sms_email_count' => Marketerz::dailyClientEmailsSMS($client, $period)], 200);
        }
    }

    /**
     *
     * Client Monthly Email SMS Count
     *
     */
    public function get_client_monthly_sms_email_count(Request $request)
    {
        $client_id = $request->client_id;
        if (isset($client_id)) {
            $client = Client::find($client_id);
            return response()->json(['sms_email_count' => Marketerz::monthlyClientEmailsSMS($client)], 200);
        }
    }
}
