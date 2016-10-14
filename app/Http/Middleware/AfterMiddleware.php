<?php

namespace App\Http\Middleware;

use Closure;

class AfterMiddleware
{
<<<<<<< HEAD
=======
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
    public function handle($request, Closure $next)
    {
        $response = $next($request);

<<<<<<< HEAD
=======
dd(1);
>>>>>>> 67a1585626508a6ca026aa8da6f7993786cf8de4
        return $response;
    }
}
