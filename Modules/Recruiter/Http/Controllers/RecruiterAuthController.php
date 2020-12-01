<?php

namespace Modules\Recruiter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterAuthController extends Controller
{

    public function getLogin()
    {
        return view('recruiter::auth.login');
    }


    public function getSignUp()
    {
        return view('recruiter::auth.signup');
    }


}
