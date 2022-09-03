<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        Gate::define('admin', function(User $user) {
            return $user->role_id === 1;
        });

        Gate::define('ustad', function(User $user) {
            return $user->role_id === 2;
        });

        Gate::define('santri', function(User $user) {
            return $user->role_id === 3;
        });
    }
}
