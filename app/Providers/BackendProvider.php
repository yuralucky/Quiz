<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\ResultRepositoryInterface',
            'App\Repositories\ResultRepository');
        $this->app->bind('App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository');
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
