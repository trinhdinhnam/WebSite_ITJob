<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function getLogin(){

        if(Auth::guard('admins')->check())
        {
            return redirect()->route('admin.dashboard');

        }else{
            return view('admin::auth.login');

        }
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::guard('admins')->attempt($credentials)){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back();
    }
}
