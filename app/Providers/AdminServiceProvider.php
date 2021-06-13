<?php

namespace App\Providers;

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
use App\Contracts\TemplateRepositoryInterface;

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
        /*  Paginator::useBootstrap(); */ }

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
