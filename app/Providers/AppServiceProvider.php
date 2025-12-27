<?php

namespace App\Providers;

use Illuminate\Auth\Access\Gate as AccessGate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function($user){
            if($user->role === 'owner'){
                return true;
            }
        });

        Gate::define('check_roles', function($user, $roles){
            return in_array($user->role, (array) $roles);
        });
    }
}
