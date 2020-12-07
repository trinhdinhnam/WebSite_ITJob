<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ApplyController extends Controller
{
    //
    public function __construct()
    {
        $positions = Position::all();
        View::share('positions',$positions);

        $jobNumber = DB::table('jobs')
            ->select(DB::raw('count(JobId) as jobNumber'))
            ->first();
        View::share('jobNumber',$jobNumber);

    }

    public function getApply($id){

        return view('apply.index');

    }
}
