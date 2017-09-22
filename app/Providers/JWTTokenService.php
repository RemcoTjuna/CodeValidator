<?php

namespace App\Providers;

use App\JWT\JWTCredentialWrapper;
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
        $this->app->singleton('App\JWT\JWTCredentialWrapper', function($app){
            return new JWTCredentialWrapper();
        });
    }
}
