<?php

namespace App\Providers;

use App\Interfaces\Interfaces\Reposity\UserReposityInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Reposity\UserReposity;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvicer extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class,UserService::class);
        $this->app->bind(UserReposityInterface::class,UserReposity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
