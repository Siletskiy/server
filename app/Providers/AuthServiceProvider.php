<?php

namespace App\Providers;

use App\Clip;
use App\Policies\NotificationPolicy;
use App\Policies\ThreadPolicy;
use App\User;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        DatabaseNotification::class => NotificationPolicy::class,
        Thread::class => ThreadPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage', function (User $user) {
            return $user->role && in_array($user->role, array_keys(config('fixtures.user_roles')));
        });

        Gate::define('administer', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
