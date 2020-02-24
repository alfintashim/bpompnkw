<?php

namespace App\Http\Middleware;
use Closure;

class Pimpinan
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->id_role = 2)
        {
            return $next($request);
        }
        
        return redirect('/');
    }
}
