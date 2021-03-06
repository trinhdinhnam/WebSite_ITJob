<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CompanyImage;
use App\Models\Position;
use App\Models\Recruiter;
use App\Models\SeekerJob;
use App\Repository\City\ICityRepository;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Skill\ISkillRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends BaseController
{
    //
    use AuthenticatesUsers;
    public $recruiterRepository;
    public $jobRepository;
    public $companyImageRepository;
    public $reviewRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository, IPositionRepository $positionRepository, IJobRepository $jobRepository, ICityRepository $cityRepository, IRecruiterRepository $recruiterRepository,ICompanyImageRepository $companyImageRepository,IReviewRepository $reviewRepository,ISkillRepository $skillRepository)
    {
        parent::__construct($seekerJobRepository, $positionRepository, $jobRepository, $cityRepository, $recruiterRepository,$skillRepository);
        $this->recruiterRepository = $recruiterRepository;
        $this->jobRepository = $jobRepository;
        $this->companyImageRepository = $companyImageRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function getHomePage(){

        $this->share();
        $companies = $this->recruiterRepository->getListRecruiters(6);
        $jobNumber = count($this->jobRepository->getAllJob());
        $jobNumberRecruiter = $this->recruiterRepository->getJobNumberByRecruiter();

        $viewData = [
            'companies' =>$companies,
            'jobNumber' => $jobNumber,
            'jobNumberRecruiter' => $jobNumberRecruiter
        ];
        //return redirect()->to('/')->with($viewData);
        return view('index',$viewData);
    }

    public function getConfirm(){
        $this->share();
        $companies = Recruiter::paginate(5);
        $viewData = [
            'companies' =>$companies
        ];
        return view('confirm.recruiter_confirm',$viewData);

    }

    public function getJobs(Request $request)
    {
        $this->share();
        $jobs = $this->jobRepository->getListJobs($request,'client');
        $companyHot = $this->recruiterRepository->getRecruiterHot();
        $jobNumberByCompanyHot = count($this->jobRepository->getJobsByCompanyHot($companyHot->id,''));
        $jobsByCompanyHot = $this->jobRepository->getJobsByCompanyHot($companyHot->id,3);
        $imageCompany = $this->companyImageRepository->getCompanyImageById($companyHot->id,1);
        $message='Success ! Lấy danh sách nhà tuyển dụng thành công !';
        $level ='success';
        $viewData = [
            'jobs' => $jobs,
            'companyHot' => $companyHot,
            'jobNumberByCompanyHot' => $jobNumberByCompanyHot,
            'jobsByCompanyHot' => $jobsByCompanyHot,
            'imageCompany' => $imageCompany,
            'flash-message' => $message,
            'flash-level' => $level
        ];
        return view('job.job-list', $viewData);
    }

    public function getDetailJob($id){
        $this->share();

        $jobDetail = $this->jobRepository->getJobById($id);
        $jobApplies = '';
        if(Auth::guard('seekers')->check()){
            $jobApplies = $this->jobRepository->getJobApplies(Auth::guard('seekers')->user()->id);
        }
        $imageCompanies = $this->companyImageRepository->getCompanyImageById($jobDetail->RecruiterId,'');

        $viewData = [
            'jobDetail' =>$jobDetail,
            'jobApplies' => $jobApplies,
            'imageCompanies'=>$imageCompanies
        ];
        return view('job.job-detail',$viewData);
    }

    public function getJobByCompany($id){
        $this->share();

        $company = $this->recruiterRepository->getRecruiterById($id);

        $jobByCompanys = $this->jobRepository->getJobByRecruiterId('',$id);
        $reviewByRecruiters = $this->reviewRepository->getReviewByRecruiter($id,5);
        $reviewHots = $this->reviewRepository->getListReviewHots($id);
        $viewData = [
            'company' => $company,
            'jobByCompanys' => $jobByCompanys,
            'reviewByRecruiters' => $reviewByRecruiters,
            'reviewHots' => $reviewHots
        ];
        return view('job.job-by-company',$viewData);
    }

    public function getJobByPosition($id){
        $this->share();

        $jobByPositions = $this->jobRepository->getJobByPositions($id);
        $companyHot = $this->recruiterRepository->getRecruiterHot();
        $jobNumberByCompanyHot = count($this->jobRepository->getJobsByCompanyHot($companyHot->id,''));
        $jobsByCompanyHot = $this->jobRepository->getJobsByCompanyHot($companyHot->id,3);
        $imageCompany = $this->companyImageRepository->getCompanyImageById($companyHot->id,1);
        $viewData = [
            'jobs' => $jobByPositions,
            'companyHot' => $companyHot,
            'jobNumberByCompanyHot' => $jobNumberByCompanyHot,
            'jobsByCompanyHot' => $jobsByCompanyHot,
            'imageCompany' => $imageCompany

        ];
        return view('job.job-list',$viewData);
    }

    public function getJobByCity($id){
        $this->share();

        $jobByCities = $this->jobRepository->getJobByCities($id);

        $companyHot = $this->recruiterRepository->getRecruiterHot();

        $jobNumberByCompanyHot = count($this->jobRepository->getJobsByCompanyHot($companyHot->id,''));

        $jobsByCompanyHot = $this->jobRepository->getJobsByCompanyHot($companyHot->id,3);

        $imageCompany = $this->companyImageRepository->getCompanyImageById($companyHot->id,1);
        $viewData = [
            'jobs' => $jobByCities,
            'companyHot' => $companyHot,
            'jobNumberByCompanyHot' => $jobNumberByCompanyHot,
            'jobsByCompanyHot' => $jobsByCompanyHot,
            'imageCompany' => $imageCompany

        ];
        return view('job.job-list',$viewData);
    }

    public function getJobBySkill($skillName){
        $this->share();

        $jobBySkills = $this->jobRepository->getJobBySkills($skillName);

        $companyHot = $this->recruiterRepository->getRecruiterHot();

        $jobNumberByCompanyHot = count($this->jobRepository->getJobsByCompanyHot($companyHot->id,''));

        $jobsByCompanyHot = $this->jobRepository->getJobsByCompanyHot($companyHot->id,3);

        $imageCompany = $this->companyImageRepository->getCompanyImageById($companyHot->id,1);
        $viewData = [
            'jobs' => $jobBySkills,
            'companyHot' => $companyHot,
            'jobNumberByCompanyHot' => $jobNumberByCompanyHot,
            'jobsByCompanyHot' => $jobsByCompanyHot,
            'imageCompany' => $imageCompany

        ];
        return view('job.job-list',$viewData);
    }

    public function getListCompany(){
        $this->share();

        $recruiters = $this->recruiterRepository->getRecruiterByPage('',10);
        $reviews = $this->recruiterRepository->getReviewHot();
        $viewData = [
            'recruiters' => $recruiters
        ];
        return view('company.index',$viewData);

    }

}