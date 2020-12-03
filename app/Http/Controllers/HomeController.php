<?php

namespace App\Http\Controllers;

use App\Models\CompanyImage;
use Illuminate\Http\Request;
use App\Models\Job;

class HomeController extends Controller
{
    //
    public function getJobs()
    {
        return view('job.job-list');    
    }

    public function getDetailJob($id){
        $jobDetail = Job::with('recruiter:id,CompanyName,Introduction,TypeBusiness,CompanySize,Address,TimeWork,WorkDay,CompanyLogo')
        ->where('JobId',$id)->first();
        $imageCompanies = CompanyImage::where('RecruiterId', $jobDetail->RecruiterId)
                        ->get();
        $viewData = [
            'jobDetail' =>$jobDetail,
            'imageCompanies'=>$imageCompanies
        ];
        return view('job.job-detail',$viewData);
    }

    public function getJobByCompany($id){
        return view('job.job-by-company');
    }
}
