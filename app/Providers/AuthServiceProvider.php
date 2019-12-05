<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Policies\UserPolicy;
use Auth;

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

        Gate::define('not-activated-show', 'App\Policies\UserPolicy@notActivatedShow');
        Gate::define('activate', 'App\Policies\UserPolicy@activate');
        Gate::define('set-password', 'App\Policies\UserPolicy@setPassword');
        Gate::define('profile', 'App\Policies\UserPolicy@profile');

      
    }
}
