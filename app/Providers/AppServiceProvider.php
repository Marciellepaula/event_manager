<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use App\Observers\PermissionObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
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
    public function boot()
    {
        Permission::observe(PermissionObserver::class);
        Gate::before(function (User $user, string $ability) {
            if (Permission::existsOnCache($ability)) {
                return $user->role->hasPermission($ability);
            }
        });



        Gate::define('isAdmin', function (User $user) {
            Log::info('Checking if user is admin: ' . $user->role_id);
            return $user->role_id === 1;
        });
    }
}
