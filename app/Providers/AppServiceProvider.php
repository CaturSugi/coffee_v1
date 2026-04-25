<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (app()->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share settings with all views
        if (!app()->runningInConsole()) {
            \Illuminate\Support\Facades\View::share('settings', \App\Models\Setting::all()->pluck('value', 'key'));
        }
    }
}
