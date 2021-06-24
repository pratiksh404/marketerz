<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Admin\Client;
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

    /**
     *
     * Client Total Email
     *
     *@return integer
     *
     */
    public function totalClientEmail(Client $client)
    {
        return Campaign::email()->where('client_id', $client->id)->get()->sum(function ($campaign) {
            return count($campaign->contacts);
        });
    }

    /**
     *
     * Client Total SMS
     *
     *@return integer
     *
     */
    public function totalClientSMS(Client $client)
    {
        return Campaign::sms()->where('client_id', $client->id)->get()->sum(function ($campaign) {
            return count($campaign->contacts);
        });
    }

    /**
     *
     * Get Daily Email and SMS
     *
     *@return array
     *
     */
    public function dailyClientEmailsSMS(Client $client, $limit = 7)
    {
        $dailyEmailsSMSCount = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $count['email'] = Campaign::where('client_id', $client->id)->email()->whereDate('updated_at', $period)->get()->sum(function ($campaign) {
                    return count($campaign->contacts);
                });
                $count['sms'] = Campaign::where('client_id', $client->id)->sms()->whereDate('updated_at', $period)->get()->sum(function ($campaign) {
                    return count($campaign->contacts);
                });

                $dailyEmailsSMSCount[$period->day] = $count;
            }
        }
        return $dailyEmailsSMSCount;
    }
    /**
     *
     * Get Monthly Email and SMS
     *
     *@return array
     *
     */
    public function monthlyClientEmailsSMS(Client $client, $given_year = null)
    {
        $monthlyEmailsSMSCount = array();
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, 12) as $month) {
            $count['email'] = Campaign::where('client_id', $client->id)->email()->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->get()->sum(function ($campaign) {
                return count($campaign->contacts);
            });
            $count['sms'] = Campaign::where('client_id', $client->id)->sms()->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->get()->sum(function ($campaign) {
                return count($campaign->contacts);
            });
            $monthlyEmailsSMSCount[Carbon::create($year, $month, 1)->format('F')] = $count;
        }
        return $monthlyEmailsSMSCount;
    }

    /**
     *
     * Client Total SMS
     *
     *@return integer
     *
     */
    public function totalClientEvaluationCost(Client $client)
    {
        return Campaign::sms()->where('client_id', $client->id)->get()->sum('estimated_cost');
    }
}
