<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\User\UserInterface;
use App\Services\User\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserService::class);
    }
}
