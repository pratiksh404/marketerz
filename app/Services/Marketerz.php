<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Admin\Campaign;

class Marketerz
{
    /**
     *
     * Get Daily Email and SMS
     *
     *@return array
     *
     */
    public function dailyEmailsSMS($limit = 7)
    {
        $dailyEmailsSMSCount = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $count['email'] = Campaign::email()->whereDate('updated_at', $period)->get()->sum(function ($campaign) {
                    return count($campaign->contacts);
                });
                $count['sms'] = Campaign::sms()->whereDate('updated_at', $period)->get()->sum(function ($campaign) {
                    return count($campaign->contacts);
                });

                $dailyEmailsSMSCount[$period->day] = $count;
            }
        }
        return $dailyEmailsSMSCount;
    }

    /**
     *
     * Daily Emails
     *
     *@return array
     *
     */
    public function dailyEmails($limit = 7)
    {
        $emailCount = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $emailCount[$period->toFormattedDateString()] = Campaign::email()->whereDate('updated_at', $period)->get()->sum(function ($campaign) {
                    return count($campaign->contacts);
                });
            }
        }
        return $emailCount;
    }
    /**
     *
     * Daily SMS
     *
     *@return array
     *
     */
    public function dailySMS($limit = 7)
    {
        $smsCount = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $smsCount[$period->toFormattedDateString()] = Campaign::sms()->whereDate('updated_at', $period)->get()->sum(function ($campaign) {
                    return count($campaign->contacts);
                });
            }
        }
        return $smsCount;
    }
    /**
     *
     * Total Email Send
     *
     *@return integer
     *
     */
    public function totalEmails()
    {
        return Campaign::email()->get()->sum(function ($campaign) {
            return count($campaign->contacts);
        });
    }

    /**
     *
     * Total SMS Send
     *
     *@return integer
     *
     */
    public function totalSMS()
    {
        return Campaign::sms()->get()->sum(function ($campaign) {
            return count($campaign->contacts);
        });
    }
}
