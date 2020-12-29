<?php

namespace App\Http\Controllers;

use App\Models\CompanyImage;
use App\Models\Job;
use App\Models\SeekerJob;
use App\Repository\City\ICityRepository;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Skill\ISkillRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    public $jobRepository;
    public $companyImageRepository;
    public $seekerJobRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository, IPositionRepository $positionRepository, IJobRepository $jobRepository, ICityRepository $cityRepository, IRecruiterRepository $recruiterRepository,ICompanyImageRepository $companyImageRepository,ISkillRepository $skillRepository)
    {
        parent::__construct($seekerJobRepository, $positionRepository, $jobRepository, $cityRepository, $recruiterRepository, $skillRepository);

        $this->jobRepository = $jobRepository;
        $this->companyImageRepository = $companyImageRepository;
        $this->seekerJobRepository = $seekerJobRepository;
    }

    public function getJobByMessage($id){

        $jobDetail = $this->jobRepository->getJobById($id);
        $jobApplies = $this->jobRepository->getJobApplies(Auth::guard('seekers')->user()->id);
        $imageCompanies = $this->companyImageRepository->getCompanyImageById($jobDetail->RecruiterId,'');
        $viewData = [
            'jobDetail' =>$jobDetail,
            'jobApplies' => $jobApplies,
            'imageCompanies'=>$imageCompanies
        ];
        $this->seekerJobRepository->changeMessageStatusById($id,Auth::guard('seekers')->user()->id);
        return view('job.job-detail',$viewData);

    }
    
}
