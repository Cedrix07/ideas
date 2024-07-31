<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        //Fetching the top 5 users that have many ideas and cache it
        $topUsers = Cache::remember('topUsers', 60 * 3 , function(){
            return User::withCount('ideas')
                    ->orderBy('ideas_count','DESC')
                    ->limit(5)->get();
        });

        //global blade variable
        View::share('topUsers', $topUsers);

    }
}
