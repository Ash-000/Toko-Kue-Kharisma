<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS di production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Daftarkan UserPolicy — proteksi akses edit/delete user di admin panel
        Gate::policy(User::class, UserPolicy::class);
    }
}
