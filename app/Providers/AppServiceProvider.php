<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AppleMusicService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AppleMusicService::class, function () {
            return new AppleMusicService();
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
