<?php

namespace App\Http\Controllers;

use App\Models\CompanyImage;
use App\Models\Position;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Models\Job;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
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
    
    public function getHomePage(){
        $companies =  DB::table('recruiters')
            ->select(DB::raw('count(JobId) as jobNumber, recruiters.id as RecruiterId, CompanyLogo, CompanyName, recruiters.City as City'))
            ->leftJoin('jobs','recruiters.id','=','jobs.RecruiterId')
            ->groupBy('recruiters.id','CompanyLogo','CompanyName','City')
            ->get();
        $viewData = [
            'companies' =>$companies
        ];
        return view('index',$viewData);

    }

    public function getJobs(Request $request)
    {
        $jobs = Job::with('recruiter:id,CompanyLogo');
        if($request->skillname) $jobs->where('Skill', 'like', '%'.$request->skillname.'%');
        $jobs = $jobs->orderByDesc('JobId')->get();

        $companyHot = DB::table('recruiters')
                               ->join('transactions','recruiters.id','=','transactions.RecruiterId')
                               ->join('account_packages','transactions.AccountPackageId','=','account_packages.AccountPackageId')
                               ->orderBy('transactions.PayDate','desc')
                               ->orderBy('account_packages.Price','desc')
                               ->first();
        $jobnumberByCompanyHot = DB::table('jobs')
            ->select(DB::raw('count(JobId) as jobNumber'))
            ->where('RecruiterId',$companyHot->id)
            ->first();

        $jobsByCompanyHot = DB::table('jobs')
            ->select('JobName')
            ->where('RecruiterId',$companyHot->id)
            ->limit(3)
            ->orderBy('created_at','desc')
            ->get();
            $imageCompany = DB::table('company_images')
                        ->select('Image')
                        ->where('RecruiterId',$companyHot->id)
                        ->first();
        $viewData = [
            'jobs' => $jobs,
            'companyHot' => $companyHot,
            'jobnumberByCompanyHot' => $jobnumberByCompanyHot,
            'jobsByCompanyHot' => $jobsByCompanyHot,
            'imageCompany' => $imageCompany
        ];
        return view('job.job-list', $viewData);
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

        $company = DB::table('recruiters')
            ->where('id',$id)
            ->first();

        $jobByCompanys = Job::with('recruiter:id,CompanyLogo')
                                ->where('RecruiterId',$id)
                                ->get();
        $viewData = [
            'company' => $company,
            'jobByCompanys' => $jobByCompanys
        ];
        return view('job.job-by-company',$viewData);
    }

    public function getJobByPosition($id){
        $jobByPositions = Job::with('recruiter:id,CompanyLogo')
            ->where('PositionId',$id)
            ->get();

        $companyHot = DB::table('recruiters')
            ->join('transactions','recruiters.id','=','transactions.RecruiterId')
            ->join('account_packages','transactions.AccountPackageId','=','account_packages.AccountPackageId')
            ->orderBy('transactions.PayDate','desc')
            ->orderBy('account_packages.Price','desc')
            ->first();

        $jobnumberByCompanyHot = DB::table('jobs')
            ->select(DB::raw('count(JobId) as jobNumber'))
            ->where('RecruiterId',$companyHot->id)
            ->groupBy('RecruiterId')
            ->first();

        $jobsByCompanyHot = DB::table('jobs')
            ->select('JobName')
            ->where('RecruiterId',$companyHot->id)
            ->limit(3)
            ->orderBy('created_at','desc')
            ->get();

        $imageCompany = DB::table('company_images')
                        ->select('Image')
                        ->where('RecruiterId',$companyHot->id)
                        ->first();
        $viewData = [
            'jobs' => $jobByPositions,
            'companyHot' => $companyHot,
            'jobnumberByCompanyHot' => $jobnumberByCompanyHot,
            'jobsByCompanyHot' => $jobsByCompanyHot,
            'imageCompany' => $imageCompany

        ];
        return view('job.job-list',$viewData);

    }
}