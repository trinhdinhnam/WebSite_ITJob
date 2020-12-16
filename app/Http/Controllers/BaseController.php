<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Position;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
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
        $cities = City::all();
        View::share('cities',$cities);
        $companies = Recruiter::all();
        View::share('companyList',$companies);
        $messageNumber = DB::table('seeker_jobs')
            ->select(DB::raw('count(JobId) as messageNumber, SeekerId'))
            ->where('SeekerId', 1)
            ->where('MessageStatus',1)
            ->groupBy('SeekerId')
            ->first();
        View::share('messageNumber',$messageNumber);
        $messageInfos = DB::table('seeker_jobs')->select(DB::raw('jobs.JobName as JobName, seeker_jobs.updated_at as MessageDate, seeker_jobs.JobId as JobId, recruiters.CompanyLogo as CompanyLogo, recruiters.CompanyName as CompanyName, seeker_jobs.MessageStatus as MessageStatus'))
            ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->where('SeekerId', 1)
            ->where('seeker_jobs.Status',1)
            ->paginate(10);
        View::share('messageInfos',$messageInfos);
    }
}
