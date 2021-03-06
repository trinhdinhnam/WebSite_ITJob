<?php

namespace Modules\Admin\Http\Controllers;

use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Job;
use App\Models\Recruiter;
use App\Models\CompanyImage;


class AdminJobController extends AdminBaseController
{
    public $recruiterRepository;
    public $jobRepository;
    public $companyImageRepository;
    public function __construct(IRecruiterRepository $recruiterRepository,IJobRepository $jobRepository,ICompanyImageRepository $companyImageRepository, ITransactionRepository $transactionRepository)
    {
        parent::__construct($transactionRepository,$jobRepository);
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
        $this->getDataShared();

        $recruiters = $this->recruiterRepository->getListRecruiters();

        $jobs = $this->jobRepository->getJobByPage($request,5);

        $viewData = [
             'jobs' => $jobs,
            'recruiters' => $recruiters
        ];
        return view('admin::job.index',$viewData);
        // return $jobs;
    }


    public function action($action,$id)
    {
        $this->getDataShared();

        try{
            if($action){
                switch($action)
                {
                    case 'active':
                        $this->jobRepository->changeStatus($id);
                        break;
                }
            }
            return redirect()->back()->with(['flash-message'=>'Success ! Duyệt bài viết thành công !','flash-level'=>'success']);
        }catch (\Exception $e){
            return redirect()->back()->with(['flash-message'=>'Error ! Duyệt bài viết thất bại !','flash-level'=>'danger']);
        }

    }

    public function getDetailJob($id){
        $this->getDataShared();

        $jobDetail = $this->jobRepository->getJobById($id);
                    $imageCompanies = $this->companyImageRepository->getCompanyImageById($jobDetail->recruiter->id,'');
                    $viewData = [
                        'jobDetail' =>$jobDetail,
                        'imageCompanies' => $imageCompanies
                    ];
        return view('admin::job.job_detail',$viewData);

    }

}