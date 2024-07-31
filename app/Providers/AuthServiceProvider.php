<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Idea;
use App\Models\User;
use App\Policies\IdeaPolicy;
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
       //if you customize your policy name declare it here..
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Gate => permission or simple role

        //role
        Gate::define('admin', function(User $user) : bool{
            return (bool) $user->is_admin;
        });
    }
}
