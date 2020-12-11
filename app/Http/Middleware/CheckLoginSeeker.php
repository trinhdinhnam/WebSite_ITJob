<?php

namespace App\Http\Middleware;
use Closure;

class CheckLoginSeeker
{
    public function handle($request, Closure $next)
    {
        if(!get_data_user('seekers'))
        {
            return redirect()->route('seeker.get.login');
        }
        return $next($request);
    }
}