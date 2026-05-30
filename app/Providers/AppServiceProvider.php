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
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tambahkan kode ini agar Laravel Vercel tidak error saat membaca storage
        if (config('app.env') === 'production') {
            $this->app->bind('path.storage', function () {
                return '/tmp';
            });
        }
    }
}