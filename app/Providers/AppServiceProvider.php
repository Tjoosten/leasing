<?php

namespace App\Providers;

use App\Models\Werkpunten;
use App\Observers\WerkpuntObserver;
use Spatie\BladeX\Facades\BladeX;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Model observers registration
        Werkpunten::observe(WerkpuntObserver::class);

        // Blade registrations
        BladeX::component('components.*');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
