<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Position;
use App\Models\Recruiter;
use App\Models\SeekerJob;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
        $cities = City::all();
        View::share('cities',$cities);
        $companies = Recruiter::all();
        View::share('companyList',$companies);
        $messageNumber = DB::table('seeker_jobs')
            ->select(DB::raw('count(JobId) as jobNumber, SeekerId'))
            ->where('SeekerId', 1)
            ->where('MessageStatus',1)
            ->groupBy('SeekerId')
            ->first();

        View::share('messageNumber',$messageNumber);
        $messageInfos = DB::table('seeker_jobs')->select(DB::raw('jobs.JobName as JobName, seeker_jobs.updated_at as MessageDate, seeker_jobs.JobId as JobId, recruiters.CompanyLogo as CompanyLogo, recruiters.CompanyName as CompanyName'))
            ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->where('SeekerId', 1)
            ->where('seeker_jobs.Status',1)
            ->get();
        View::share('messageInfos',$messageInfos);
    }

    public function getApply($id)
    {
        return view('apply.index');

    }

    public function postApply(Request $request,$id){
        $seekerJob = new SeekerJob();
        $seekerJob->SeekerId = Auth::guard('seekers')->user()->id;
        $seekerJob->JobId = $id;
        $seekerJob->Introduce = $request->Introduce;
        if($request->hasFile('CVLink'))
        {
            $fileCV = $request->file('CVLink');
            $fileCVLink = upload_cv($fileCV,$fileCV->getClientOriginalName());
            if(isset($fileCVLink['name'])){
                $seekerJob->CVLink = $fileCVLink['name'];
            }
        }
        $seekerJob->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $seekerJob->save();
        return redirect()->route('index')->with(['flash-message'=>'Success ! Ứng tuyển công việc thành công !','flash-level'=>'success']);


    }
}
