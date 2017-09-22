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
        if ($code) {
            $verify = JWTWrapper::verify($code, App::make('App\JWT\JWTWrapper'));
            if ($verify['verify'] && $verify['validate']) {
                $data = array();

                foreach ($verify['content'] as $value) {
                    if (is_array($value)) {
                        foreach (array_keys($value) as $embeddedKey) {
                            array_push($data, [$embeddedKey => $value[$embeddedKey]]);
                        }
                    }
                }
                $data = array_merge(...array_map(function ($key) {
                    return $key;
                }, $data));

                return response(view('guest.insert_code', $data), 200);
            }
            session()->remove('code');
        }
        view()->share('form', false);
        return $next($request);
    }
}
