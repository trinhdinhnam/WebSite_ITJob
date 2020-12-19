<?php

namespace Modules\Recruiter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterTransactionController extends Controller
{
    public function getBill(Request $request){
        if($request->ajax()) {
            $html = view('recruiter::payment.bill')->render();
            return \response()->json($html);
        }
    }


}
