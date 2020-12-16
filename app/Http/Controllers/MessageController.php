<?php

namespace App\Http\Controllers;

use App\Models\CompanyImage;
use App\Models\Job;
use App\Models\SeekerJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    public function getJobByMessage($id){

        $jobDetail = Job::with('recruiter:id,CompanyName,Introduction,TypeBusiness,CompanySize,Address,TimeWork,WorkDay,CompanyLogo')
            ->with('seekerJob:SeekerJobId,JobId,SeekerId');
        $jobDetail = $jobDetail->where('jobs.JobId',$id)->first();
        $imageCompanies = CompanyImage::where('RecruiterId', $jobDetail->RecruiterId)
            ->get();
        $viewData = [
            'jobDetail' =>$jobDetail,
            'imageCompanies'=>$imageCompanies
        ];

        $seekerJob = SeekerJob::where('JobId',$id)
                              ->where('SeekerId',Auth::guard('seekers')->user()->id)
                              ->first();
        $seekerJob->MessageStatus = 0;
        $seekerJob->save();
        return view('job.job-detail',$viewData);

    }
    
}
