<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: User actions
        Gate::define('user_action_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Doors
        Gate::define('door_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('door_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('door_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('door_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('door_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Stautus
        Gate::define('stautus_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('stautus_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('stautus_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('stautus_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('stautus_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Pasts
        Gate::define('past_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('past_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('past_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('past_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('past_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
