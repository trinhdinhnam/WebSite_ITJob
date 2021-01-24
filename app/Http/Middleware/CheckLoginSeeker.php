<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginSeeker
{
    public function handle($request, Closure $next)
    {
        if(!get_data_user('seekers'))
        {
            return redirect()->route('client.get.home.page');
        }
        else{
            if(Auth::guard('seekers')->user()->Active == 0 ){
                Auth::guard('seekers')->logout();
                return redirect()->route('client.get.home.page');
            }
        }
        return $next($request);
    }
}