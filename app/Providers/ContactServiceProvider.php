<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contact\ContactInterface;
use App\Services\Contact\ContactService;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContactInterface::class, ContactService::class);
    }
}
