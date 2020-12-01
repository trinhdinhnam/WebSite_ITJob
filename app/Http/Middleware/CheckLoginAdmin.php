<?php

namespace App\Http\Middleware;
use Closure;

class CheckLoginAdmin
{
    public function handle($request, Closure $next)
    {
        if(!get_data_user('web'))
        {
            return redirect()->route('recruiter.login');
        }
        return $next($request);
    }
}