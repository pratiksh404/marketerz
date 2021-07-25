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

    /**
     *
     * Get Week Payment
     *
     */
    public function get_week_payment()
    {
        return response()->json(['weekly_payment' => Marketerz::dailyPayments(7)], 200);
    }

    /**
     *
     * Get Monthly Payment
     *
     */
    public function get_monthly_payment()
    {
        return response()->json(['monthly_payment' => Marketerz::monthlyPayments()], 200,);
    }

    /**
     *
     * Daily Client Payment
     *
     */
    public function daily_client_payment(Request $request)
    {
        $client = Client::find($request->client_id);
        $limit = $request->limit;
        return response()->json(['daily_client_payment' => Marketerz::dailyClientPayments($client, $limit)], 200,);
    }

    /**
     *
     * Monthly Client Payment
     *
     */
    public function monthly_client_payment(Request $request)
    {
        $client = Client::find($request->client_id);
        return response()->json(['monthly_client_payment' => Marketerz::monthlyClientPayments($client)], 200,);
    }
    /**
     *
     * Daily Client Advance
     *
     */
    public function daily_client_advance(Request $request)
    {
        $client = Client::find($request->client_id);
        $limit = $request->limit;
        return response()->json(['daily_client_advance' => Marketerz::dailyClientAdvances($client, $limit)], 200,);
    }

    /**
     *
     * Monthly Client Advance
     *
     */
    public function monthly_client_advance(Request $request)
    {
        $client = Client::find($request->client_id);
        return response()->json(['monthly_client_advance' => Marketerz::monthlyClientAdvances($client)], 200,);
    }

    /**
     *
     * Monthly Payment Advance Return
     *
     */
    public function monthly_payment_advance_return()
    {
        return response()->json([
            'monthly_payment' => Marketerz::monthlyPayments(),
            'monthly_advance' => Marketerz::monthlyAdvances(),
            'monthly_return' => Marketerz::monthlyReturns()
        ], 200);
    }

    /**
     *
     * Debit VS Credit
     *
     */
    public function get_debit_credit()
    {
        return response()->json([
            'debit' => Marketerz::totalDebit(),
            'credit' => Marketerz::totalCredit()
        ], 200);
    }
}
