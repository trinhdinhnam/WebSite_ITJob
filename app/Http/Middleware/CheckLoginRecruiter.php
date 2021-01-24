<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginRecruiter
{
    public function handle($request, Closure $next)
    {
        if(!get_data_user('recruiters'))
        {
            return redirect()->route('recruiter.get.login');
        }
        else{
            if(Auth::guard('recruiters')->user()->Active == 0 || Auth::guard('recruiters')->user()->IsDelete == 0){
                Auth::guard('recruiters')->logout();
                return redirect()->route('recruiter.get.login');
            }
        }
        return $next($request);
    }
}