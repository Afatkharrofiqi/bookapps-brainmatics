<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('list-category', function($user){
            return in_array($user->roles, ['ADMIN', 'USER']);
        });

        Gate::define('create-category', function($user){
            return in_array($user->roles, ['ADMIN']);
        });

        Gate::define('update-category', function($user){
            return in_array($user->roles, ['ADMIN']);
        });

        Gate::define('delete-category', function($user){
            return in_array($user->roles, ['ADMIN']);
        });

        Gate::define('list-book', function($user){
            return in_array($user->roles, ['ADMIN', 'USER']);
        });

        Gate::define('create-book', function($user){
            return in_array($user->roles, ['ADMIN']);
        });

        Gate::define('update-book', function($user){
            return in_array($user->roles, ['ADMIN']);
        });

        Gate::define('delete-book', function($user){
            return in_array($user->roles, ['ADMIN']);
        });
    }
}
