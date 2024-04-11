<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('permissions')) {
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                Gate::define($permission->slug, static function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }

        Gate::before(static function (User $user, $permission) {
            if ($user->permissions()->contains($permission)) {
                return true;
            }
            return null;
        });
    }
}
