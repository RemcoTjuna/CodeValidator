<?php

namespace App\Providers;

use App\JWT\JWTWrapper;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;


class JWTTokenService extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\JWT\JWTWrapper', function($app){
            return new JWTWrapper();
        });
    }
}
