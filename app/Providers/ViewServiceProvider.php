<?php

namespace App\Providers;

use App\Composers\DashboardComposer;
use Illuminate\Support\ServiceProvider;

/**
 * ViewServiceProvider
 * --- 
 * Service provider for registering all the composer that register variables globally to blade views. 
 * 
 * @package App\Providers
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        view()->composer('home', DashboardComposer::class);
    }
}
