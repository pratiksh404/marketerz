<?php

namespace App\Mixins;

use App\Http\Controllers\Admin\AdvanceController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DiscussionController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SourceController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TemplateController;

class AdminRouteMixin
{
    /**
     *
     * Admin Routes
     *
     */
    public function admin()
    {
        return function () {
            Route::group(['prefix' => config('adminetic.prefix', 'admin'), 'middleware' => config('adminetic.middleware')], function () {
                $this->resource('contact', ContactController::class);
                $this->resource('group', GroupController::class);
                $this->resource('client', ClientController::class);
                $this->resource('source', SourceController::class);
                $this->resource('service', ServiceController::class);
                $this->resource('template', TemplateController::class);
                $this->resource('campaign', CampaignController::class);
                $this->resource('task', TaskController::class);
                $this->resource('lead', LeadController::class);
                $this->resource('department', DepartmentController::class);
                $this->resource('package', PackageController::class);
                $this->resource('discussion', DiscussionController::class);
                $this->resource('project', ProjectController::class);
                $this->resource('payment', PaymentController::class, [
                    'except' => ['create', 'store']
                ]);
                $this->resource('advance', AdvanceController::class, [
                    'except' => ['create', 'store']
                ]);

                /* SINGLE ROUTES */
                $this->post('import-contacts', [ContactController::class, 'import'])->name('import_contacts');
                $this->post('export-contacts', [ContactController::class, 'export'])->name('export_contacts');
                $this->post('import-group-contacts/{group}', [GroupController::class, 'import'])->name('import_group_contacts');
                $this->post('import-client-contacts/{client}', [ClientController::class, 'import'])->name('import_client_contacts');
                $this->get('get-channel-templates', [TemplateController::class, 'get_channel_templates'])->name('get_channel_templates');
                $this->get('get-template', [TemplateController::class, 'get_template'])->name('get_template');
                $this->get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
                $this->get('failed-jobs', [JobController::class, 'failed_jobs'])->name('failed_jobs');
                $this->get('show-failed-job/{uuid}', [JobController::class, 'show_failed_job'])->name('show_failed_job');
                $this->get('processes', [JobController::class, 'processes'])->name('processes');
                $this->get('lead-discussions/{lead}', [LeadController::class, 'lead_discussions'])->name('lead_discussions');
                $this->post('store-lead-discussion', [LeadController::class, 'store_lead_discussion'])->name('store_lead_discussion');
                $this->get('project-payment/{project}', [ProjectController::class, 'project_payment'])->name('project_payment');
                $this->post('store-project-payment/{project}', [ProjectController::class, 'store_project_payment'])->name('store_project_payment');
                $this->get('project-return/{project}', [ProjectController::class, 'project_return'])->name('project_return');
                $this->post('store-project-return/{project}', [ProjectController::class, 'store_project_return'])->name('store_project_return');
                $this->get('client-advance/{client}', [ClientController::class, 'client_advance'])->name('client_advance');
                $this->post('store-client-advance/{client}', [ClientController::class, 'store_client_advance'])->name('store_client_advance');
                $this->get('convert-to-client/{lead}', [ProjectController::class, 'convert_to_client'])->name('convert_to_client');

                /* INVOICE ROUTES */
                $this->get('payment-invoice/{payment}', [PaymentController::class, 'payment_invoice'])->name('payment_invoice');
                $this->get('project-invoice/{project}', [ProjectController::class, 'project_invoice'])->name('project_invoice');
                $this->get('advance-invoice/{advance}', [AdvanceController::class, 'advance_invoice'])->name('advance_invoice');
                $this->get('make-client-project-invoice/{client}', [ClientController::class, 'make_client_project_invoice'])->name('make_client_project_invoice');
                $this->post('client-project-invoice/{client}', [ClientController::class, 'client_project_invoice'])->name('client_project_invoice');

                /* Report Routes */
                $this->get('payment-report', [ReportController::class, 'payment_report'])->name('payment_report');
                $this->get('project-report', [ReportController::class, 'project_report'])->name('project_report');
                $this->get('advance-report', [ReportController::class, 'advance_report'])->name('advance_report');


                /* CHARTS ROUTES */
                $this->get('get-daily-sms-email-count', [ChartController::class, 'get_daily_sms_email_count'])->name('get_daily_sms_email_count');
                $this->get('get-daily-sms-count', [ChartController::class, 'get_daily_sms_count'])->name('get_daily_sms_count');
                $this->get('get-daily-email-count', [ChartController::class, 'get_daily_email_count'])->name('get_daily_email_count');
                $this->get('get-client-email-count', [ChartController::class, 'get_client_sms_email_count'])->name('get_client_sms_email_count');
                $this->get('get-client-monthly-email-count', [ChartController::class, 'get_client_monthly_sms_email_count'])->name('get_client_monthly_sms_email_count');
                $this->get('get-week-payment', [ChartController::class, 'get_week_payment'])->name('get_week_payment');
                $this->get('get-monthly-payment', [ChartController::class, 'get_monthly_payment'])->name('get_monthly_payment');
                $this->get('daily-client-payment', [ChartController::class, 'daily_client_payment'])->name('daily_client_payment');
                $this->get('monthly-client-payment', [ChartController::class, 'monthly_client_payment'])->name('monthly_client_payment');
                $this->get('daily-client-advance', [ChartController::class, 'daily_client_advance'])->name('daily_client_advance');
                $this->get('monthly-client-advance', [ChartController::class, 'monthly_client_advance'])->name('monthly_client_advance');
                $this->get('monthly-payment-advance-return', [ChartController::class, 'monthly_payment_advance_return'])->name('monthly_payment_advance_return');
                $this->get('get-debit-credit', [ChartController::class, 'get_debit_credit'])->name('get_debit_credit');
            });
        };
    }
}
