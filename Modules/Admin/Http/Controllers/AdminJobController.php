<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Job;
use App\Models\Recruiter;


class AdminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $recruiters = Recruiter::all();

        $jobs = Job::with('position:PositionId,PositionName');

        if($request->jobname) $jobs->where('JobName', 'like', '%'.$request->jobname.'%');
        if($request->recruiter) $jobs->where('RecruiterId',$request->recruiter);

        $jobs = $jobs->orderByDesc('JobId')->get();
        $viewData = [
             'jobs' => $jobs,
            'recruiters' => $recruiters
        ];
        return view('admin::job.index',$viewData);
        // return $jobs;
    }


    public function action($action,$id)
    {
        $job = Job::find($id);

        if($action){
            switch($action)
            {
                case 'active':
                    $job->Status = $job->Status ? 0 : 1;
                    $job->save();
                break;
            }
        }
        return redirect()->back();
    }

    public function getDetailJob($id){
        $jobDetail = Job::with('recruiter:id,CompanyName,Introduction,TypeBusiness,CompanySize,Address,TimeWork,WorkDay')
                    ->where('JobId',$id)->first();
                    $viewData = [
                        'jobDetail' =>$jobDetail
                    ];
        return view('admin::job.job_detail',$viewData);

    }

}