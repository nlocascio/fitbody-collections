<?php

namespace App\Providers;

use App\Services\MindBodyService;
use App\User;
use Auth;
use Illuminate\Support\ServiceProvider;

class MindbodyAuthServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('mindbody', function($app) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new MindbodyUserProvider(new User, new MindBodyService);
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}