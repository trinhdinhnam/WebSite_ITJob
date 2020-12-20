<?php

namespace App\Http\Middleware;
use Closure;

class CheckLoginRecruiter
{
    public function handle($request, Closure $next)
    {
        if(!get_data_user('recruiters'))
        {
            return redirect()->route('recruiter.get.login');
        }
        return $next($request);
    }
}