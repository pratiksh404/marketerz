<?php

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Admin\Lead;
use App\Models\Admin\Client;
use App\Models\Admin\Advance;
use App\Models\Admin\Payment;
use App\Models\Admin\Project;
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

    /**
     *
     * Total Lead Discussions
     *
     *@return integer
     *
     */
    public function totalLeadDiscussions($leads)
    {
        return $leads->sum(function ($lead) {
            return isset($lead->discussions) ? $lead->discussions->count() : 0;
        });
    }
    /**
     *
     * Total Status Lead Discussions
     *
     *@return integer
     *
     */
    public function totalStatusLeadDiscussions($status)
    {
        return Lead::where('status', $status)->count();
    }

    /**
     *
     * Daily Payment
     *
     */
    public function dailyPayments($limit = 7)
    {
        $dailyPayment = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $dailyPayment[$period->toFormattedDateString()] = Payment::whereDate('updated_at', $period)->sum('payment');
            }
        }
        return $dailyPayment;
    }

    /**
     *
     * Monthly Payment
     *
     */
    public function monthlyPayments($given_year = null)
    {
        $monthlyPayment = array();
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, 12) as $month) {
            $monthlyPayment[Carbon::create($year, $month, 1)->format('F')] = Payment::whereYear('updated_at', $year)->whereMonth('updated_at', $month)->sum('payment');
        }
        return $monthlyPayment;
    }

    /**
     *
     * Total Client Payment
     *
     */
    public function totalClientPayments($client)
    {
        $total_payment = 0;
        $projects = Project::where('client_id', $client->id)->get();
        foreach ($projects as $project) {
            if ($project->payments) {
                $total_payment += $project->payments->sum('payment');
            }
        }
        return $total_payment;
    }

    /**
     *
     * Daily Advance
     *
     */
    public function dailyAdvances($limit = 7)
    {
        $dailyAdvance = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $dailyAdvance[$period->toFormattedDateString()] = Advance::whereDate('updated_at', $period)->sum('amount');
            }
        }
        return $dailyAdvance;
    }

    /**
     *
     * Monthly Advance
     *
     */
    public function monthlyAdvances($given_year = null)
    {
        $monthlyAdvance = array();
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, 12) as $month) {
            $monthlyAdvance[Carbon::create($year, $month, 1)->format('F')] = Advance::whereYear('updated_at', $year)->whereMonth('updated_at', $month)->sum('amount');
        }
        return $monthlyAdvance;
    }

    /**
     *
     * Daily Client Payment
     *
     */
    public function dailyClientPayments($client, $limit = 7)
    {
        $dailyClientPayment = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $projects = Project::whereDate('updated_at', $period)->where('client_id', $client->id)->get();
                $total_payment = 0;
                foreach ($projects as $project) {
                    if ($project->payments) {
                        $total_payment += $project->payments->sum('payment');
                    }
                }
                $dailyClientPayment[$period->toFormattedDateString()] = $total_payment;
            }
        }
        return $dailyClientPayment;
    }

    /**
     *
     * Monthly Payment
     *
     */
    public function monthlyClientPayments($client, $given_year = null)
    {
        $monthlyClientPayment = array();
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, 12) as $month) {
            $projects = Project::whereYear('updated_at', $year)->whereMonth('updated_at', $month)->where('client_id', $client->id)->get();
            $total_payment = 0;
            foreach ($projects as $project) {
                if ($project->payments) {
                    $total_payment += $project->payments->sum('payment');
                }
            }
            $monthlyClientPayment[Carbon::create($year, $month, 1)->format('F')] = $total_payment;
        }
        return $monthlyClientPayment;
    }

    /**
     *
     * Daily Client Advance
     *
     */
    public function dailyClientAdvances($client, $limit = 7)
    {
        $dailyClientAdvance = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $total_advance = Advance::where('client_id', $client->id)->whereDate('updated_at', $period)->sum('amount');
                $dailyClientAdvance[$period->toFormattedDateString()] = $total_advance;
            }
        }
        return $dailyClientAdvance;
    }

    /**
     *
     * Monthly Advance
     *
     */
    public function monthlyClientAdvances($client, $given_year = null)
    {
        $monthlyClientAdvance = array();
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, 12) as $month) {
            $total_advance = Advance::where('client_id', $client->id)->whereYear('updated_at', $year)->whereMonth('updated_at', $month)->sum('amount');
            $monthlyClientAdvance[Carbon::create($year, $month, 1)->format('F')] = $total_advance;
        }
        return $monthlyClientAdvance;
    }

    /**
     *
     * Daily Return
     *
     */
    public function dailyReturns($limit = 7)
    {
        $dailyReturn = array();
        $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
        if (isset($periods)) {
            foreach ($periods as $period) {
                $dailyReturn[$period->toFormattedDateString()] = Project::whereDate('updated_at', $period)->where('cancel', 1)->sum('return');
            }
        }
        return $dailyReturn;
    }

    /**
     *
     * Monthly Return
     *
     */
    public function monthlyReturns($given_year = null)
    {
        $monthlyReturn = array();
        $year = $given_year ?? Carbon::now()->year;
        foreach (range(1, 12) as $month) {
            $monthlyReturn[Carbon::create($year, $month, 1)->format('F')] = Project::whereYear('updated_at', $year)->whereMonth('updated_at', $month)->where('cancel', 1)->sum('return');
        }
        return $monthlyReturn;
    }

    // TOTAL AMOUNTS

    /**
     *
     * Total Payment
     *
     *@return integer
     *
     */
    public function totalPayment($given_payments = null)
    {
        $payments = $given_payments ?? Payment::all();
        return $payments->sum('payment');
    }


    /**
     *
     * Total Advance
     *
     *@return integer
     *
     */
    public function totalAdvance($iven_advances = null)
    {
        $advances = $iven_advances ?? Advance::all();
        return $advances->sum('amount');
    }

    /**
     *
     * Total Remaining Amount
     *
     *@return integer
     *
     */
    public function totalRemainingAmount($given_projects = null)
    {
        $projects = $given_projects ?? Project::all();
        $total_remaining_amount = 0;
        foreach ($projects as $project) {
            $total_remaining_amount += $project->remaining_amount;
        }
        return $total_remaining_amount;
    }

    /**
     *
     * Total Paid Amount
     *
     *@return integer
     *
     */
    public function totalPaidAmount($given_projects = null)
    {
        $projects = $given_projects ?? Project::all();
        return $projects->sum('paid_amount');
    }

    /**
     *
     * Total Credit
     *
     *@return integer
     *
     */
    public function totalCredit($given_clients = null)
    {
        $clients = $given_clients ?? Client::all();
        return $clients->sum('credit');
    }

    /**
     *
     * Total Debit
     *
     *@return integer
     *
     */
    public function totalDebit($given_clients = null)
    {
        $clients = $given_clients ?? Client::all();
        return $clients->sum('debit');
    }

    /**
     *
     * Total Projects
     *
     *@return integer
     *
     */
    public function totalProjects($given_projects = null)
    {
        return isset($given_projects) ? $given_projects->count() : Project::count();
    }

    /**
     *
     * Total Leads
     *
     *@return integer
     *
     */
    public function totalLeads($given_leads = null)
    {
        return isset($given_leads) ? $given_leads->count() : Lead::count();
    }

    /**
     *
     * Project Count
     *
     */
    public function projectCount()
    {
        $allprojectscount = Project::count();
        $ongoingprojectscount = Project::where('project_deadline', '>', Carbon::now())->count();
        $cancelledProjectscount = Project::where('cancel', 1)->count();
        $deadlineprojectscount = Project::where(
            [
                ['project_deadline', '<', Carbon::now()],
                ['cancel', '=', 0],
            ]
        )->get()->where('remaining_amount', '<>', 0)->count();
        $finishedprojectscount = Project::where(
            [
                ['project_deadline', '<', Carbon::now()],
                ['cancel', '=', 0],
            ]
        )->get()->where('remaining_amount', '=', 0)->count();

        return [
            'allprojectscount' => $allprojectscount,
            'ongoingprojectscount' => $ongoingprojectscount,
            'cancelledProjectscount' => $cancelledProjectscount,
            'deadlineprojectscount' => $deadlineprojectscount,
            'finishedprojectscount' => $finishedprojectscount,
        ];
    }

    /* ================================PAYMENT REPORT================================ */

    /**
     *
     * Payment Report
     *
     */
    public function paymentReport($payments, $type, $limit = 7)
    {
        $paymentTotal = null;
        switch ($type) {
            case 1:
                $paymentTotal = $this->getPaymentTotal($payments->get());
            case 2:
                $total = array();
                $periods = CarbonPeriod::create(Carbon::now()->subdays($limit), Carbon::now());
                if (isset($periods)) {
                    foreach ($periods as $period) {
                        $period_payments = $payments->whereDate($period)->get();
                        $total[$period->toFormattedDateString()] = $this->getPaymentTotal($period_payments);
                    }
                    $paymentTotal = $total;
                }
            case 3:
                $total = array();
                foreach (range(1, 12) as $month) {
                    $total[Carbon::create($payments->first()->updated_at)->format('F')] = $this->getPaymentTotal(Payment::whereMonth('updated_at', $month)->get());
                }
                $paymentTotal = $total;
        }
    }

    public function getPaymentTotal($payments)
    {
        $total = array();
        $total['total_project_count'] = count(array_unique($payments->pluck('project_id')->toArray()));
        $total['total_campaign_count'] = count(array_unique($payments->pluck('campaign_id')->toArray()));
        $total['total_payment_method_count'] = count(array_unique($payments->pluck('payment_method')->toArray()));
        $total['total_payment_count'] = $payments->count();
        $total['total_payment'] = $payments->sum('payment');
        return $total;
    }
}
