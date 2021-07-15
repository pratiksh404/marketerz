<?php

namespace App\Mixins;

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
                $this->resource('payment', PaymentController::class);

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


                /* CHARTS ROUTES */
                $this->get('get-daily-sms-email-count', [ChartController::class, 'get_daily_sms_email_count'])->name('get_daily_sms_email_count');
                $this->get('get-daily-sms-count', [ChartController::class, 'get_daily_sms_count'])->name('get_daily_sms_count');
                $this->get('get-daily-email-count', [ChartController::class, 'get_daily_email_count'])->name('get_daily_email_count');
                $this->get('get-client-email-count', [ChartController::class, 'get_client_sms_email_count'])->name('get_client_sms_email_count');
                $this->get('get-client-monthly-email-count', [ChartController::class, 'get_client_monthly_sms_email_count'])->name('get_client_monthly_sms_email_count');
            });
        };
    }
}
