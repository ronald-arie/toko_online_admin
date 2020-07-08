<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = config('permissions.permissions');
        foreach($permissions as $key => $permission) {
            foreach($permission as $action){
                Gate::define("$key.$action", function ($user) use ($key, $action) {
                    if (!$user->role->is_active) {
                        return false;
                    }
                    $user_permissions = json_decode($user->role->permissions, true);
                    if (in_array($action, $user_permissions[$key])) {
                        return true;
                    }
                    return false;
                });
            }
        }
    }
}
