<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use UserServiceImpl;

class UserServiceProvider extends ServiceProvider
{


    public array $singletons = [
        UserService::class => UserServiceImpl::class
    ];

    public function provides(): array
    {
        return [UserService::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
