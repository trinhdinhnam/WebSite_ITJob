<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends AdminBaseController
{
    public function getLogin(){
        $this->getDataShared();

        if(Auth::guard('admins')->check())
        {
            return redirect()->route('admin.dashboard');

        }else{
            return view('admin::auth.login');

        }
    }

    public function postLogin(Request $request)
    {
        $this->getDataShared();

        $credentials = $request->only('email','password');
        if(Auth::guard('admins')->attempt($credentials)){
            return redirect()->route('admin.dashboard')->with(['flash-message'=>'Success ! Đăng nhập thành công !','flash-level'=>'success']);
        }
        return redirect()->back()->with(['flash-message'=>'Error ! Mật khẩu hoặc email của bạn chưa đúng !','flash-level'=>'danger']);
    }
}
