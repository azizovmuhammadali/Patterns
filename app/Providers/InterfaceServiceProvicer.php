<?php

namespace App\Providers;

use App\Interfaces\Reposity\BookReposityInterface;
use App\Interfaces\Services\BookServiceInterface;
use App\Reposity\BookReposity;
use App\Services\BookService;
use App\Services\UserService;
use App\Reposity\UserReposity;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\UserServiceInterface;
use App\Interfaces\Reposity\UserReposityInterface;

class InterfaceServiceProvicer extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class,UserService::class);
        $this->app->bind(UserReposityInterface::class,UserReposity::class);
        $this->app->bind(BookServiceInterface::class,BookService::class);
        $this->app->bind(BookReposityInterface::class,BookReposity::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
