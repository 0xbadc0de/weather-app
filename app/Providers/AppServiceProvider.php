<?php

namespace App\Providers;

use App\Services\Weather\WeatherProvider;
use App\Services\Weather\WeatherProviderFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WeatherProvider::class, function () {
            return WeatherProviderFactory::build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
