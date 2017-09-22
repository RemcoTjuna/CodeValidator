<?php

namespace App\Http\Middleware;

use App\JWT\JWTWrapper;
use Closure;
use Illuminate\Support\Facades\App;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $code = session('code');
        if($code) {

            dd(App::make('App\JWT\JWTWrapper'));
            if(JWTWrapper::verify($code, App::make('App\JWT\JWTWrapper'))){

            }
            //Validate
        //    return view('guest.insert_code')->with('form', true);

            dd(JWTWrapper::verify($code, App::make('App\JWT\JWTWrapper')));
            return response(JWTWrapper::verify($code, App::make('App\JWT\JWTWrapper')), 200);
        }
        return $next($request);
    }
}
