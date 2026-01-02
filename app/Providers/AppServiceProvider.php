<?php

namespace App\Providers;

use App\Listeners\LogRoomLeaveListener;
use App\Services\ReverbApi;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Reverb\Events\MessageReceived;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('reverb-api', ReverbApi::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
