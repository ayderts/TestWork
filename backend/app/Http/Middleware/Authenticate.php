<?php

namespace App\Http\Middleware;

use Closure;
use http\Cookie;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    public function handle($request, Closure $next, ...$guards)
    {
        if ($jwt = $request->cookie('jwt')){
            $request->headers->set('Authorization', 'Bearer '.$jwt);
        }
        $this->authenticate($request, $guards);

        return $next($request);
    }
    public function logout(){
        return response([
            'message'=>'Выход из учетной записи выполнен'
        ])->withCookie(Cookie::forget('jwt'));
    }

}
