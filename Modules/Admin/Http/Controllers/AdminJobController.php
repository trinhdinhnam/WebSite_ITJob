<?php

namespace Modules\Admin\Http\Controllers;

use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Job;
use App\Models\Recruiter;
use App\Models\CompanyImage;


class AdminJobController extends Controller
{
    public $recruiterRepository;
    public $jobRepository;
    public $companyImageRepository;
    public function __construct(IRecruiterRepository $recruiterRepository,IJobRepository $jobRepository,ICompanyImageRepository $companyImageRepository)
    {
        $this->recruiterRepository = $recruiterRepository;
        $this->jobRepository = $jobRepository;
        $this->companyImageRepository = $companyImageRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $recruiters = $this->recruiterRepository->getListRecruiters();

        $jobs = $this->jobRepository->getListJobs($request,'admin');

        $viewData = [
             'jobs' => $jobs,
            'recruiters' => $recruiters
        ];
        return view('admin::job.index',$viewData);
        // return $jobs;
    }


    public function action($action,$id)
    {
        try{
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
            return redirect()->back()->with(['flash-message'=>'Success ! Duyệt bài viết thành công !','flash-level'=>'success']);
        }catch (\Exception $e){
            return redirect()->back()->with(['flash-message'=>'Error ! Duyệt bài viết thất bại !','flash-level'=>'danger']);
        }

    }

    public function getDetailJob($id){
        $jobDetail = $this->jobRepository->getJobById($id);
                    $imageCompanies = $this->companyImageRepository->getCompanyImageById($jobDetail->recruiter->id,'');
                    $viewData = [
                        'jobDetail' =>$jobDetail,
                        'imageCompanies' => $imageCompanies
                    ];
        return view('admin::job.job_detail',$viewData);

    }

}