<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin::index');
    }

    public function getLogout(){
        Auth::guard('admins')->logout();
        return redirect()->route('admin.get.login');
    }

}
