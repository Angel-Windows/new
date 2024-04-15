<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class redirectFirst
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang=app()->getLocale();
        
        if ($lang=='ru') {
            return redirect('/ru');
        }
        
        return $next($request);
    }
}
