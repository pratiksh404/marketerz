<?php

namespace App\Providers;

use App\Contracts\AdvanceRepositoryInterface;
use App\Services\Marketerz;
use App\Mixins\AdminRouteMixin;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use App\Repositories\GroupRepository;
use Illuminate\Support\Facades\Route;
use App\Repositories\ClientRepository;
use App\Repositories\SourceRepository;
use App\Repositories\ContactRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CampaignRepository;
use App\Repositories\TemplateRepository;
use App\Contracts\GroupRepositoryInterface;
use App\Contracts\ClientRepositoryInterface;
use App\Contracts\SourceRepositoryInterface;
use App\Contracts\ContactRepositoryInterface;
use App\Contracts\ServiceRepositoryInterface;
use App\Contracts\CampaignRepositoryInterface;
use App\Contracts\DepartmentRepositoryInterface;
use App\Contracts\DiscussionRepositoryInterface;
use App\Contracts\ExpenseRepositoryInterface;
use App\Contracts\LeadRepositoryInterface;
use App\Contracts\PackageRepositoryInterface;
use App\Contracts\PaymentRepositoryInterface;
use App\Contracts\ProjectRepositoryInterface;
use App\Contracts\TaskRepositoryInterface;
use App\Contracts\TemplateRepositoryInterface;
use App\Repositories\AdvanceRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\DiscussionRepository;
use App\Repositories\ExpenseRepository;
use App\Repositories\LeadRepository;
use App\Repositories\PackageRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /* Route Macro */
        Route::mixin(new AdminRouteMixin());
        /* Repository Interface Binding */
        $this->repos();
        // Register Facades
        $this->getFacades();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Registering Blade Directives
        /*    Paginator::useBootstrap(); */ }

    // Repository Interface Binding
    protected function repos()
    {
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(SourceRepositoryInterface::class, SourceRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
        $this->app->bind(CampaignRepositoryInterface::class, CampaignRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(DiscussionRepositoryInterface::class, DiscussionRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(AdvanceRepositoryInterface::class, AdvanceRepository::class);
        $this->app->bind(ExpenseRepositoryInterface::class, ExpenseRepository::class);
    }

    /**
     *
     * Register Facades
     *
     */
    protected function getFacades()
    {
        App::bind('marketerz', function () {
            return new Marketerz;
        });
    }
}
