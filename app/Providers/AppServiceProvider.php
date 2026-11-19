<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('kelola-buku', function ($user) {
            if (method_exists($user, 'hasAnyRole')) {
                return $user->hasAnyRole(['admin', 'petugas']);
            }

            $role = strtolower((string) ($user->role ?? ''));

            return in_array($role, ['admin', 'petugas'], true);
        });
    }
}