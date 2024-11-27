<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
 //\App\Models\Category::all()

 use App\Services\BCICChatService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind BCICChatService
        $this->app->singleton(BCICChatService::class, function ($app) {
            return new BCICChatService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

         //View::share('somedata', 'allinfo');
         
    }
}
