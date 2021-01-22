<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Repository\City\ICityRepository;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Job\JobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Job;
use App\Models\Position;
use App\Models\Language;
use App\Models\SeekerJob;

use App\Http\Requests\RequestJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RecruiterJobController extends RecruiterBaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public $jobRepository;
    public $positionRepository;
    public $companyImageRepository;
    public $transactionRepository;
    public $recruiterRepository;
    public $cityRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository,IJobRepository $jobRepository, IPositionRepository $positionRepository, ICompanyImageRepository $companyImageRepository,ITransactionRepository $transactionRepository,IRecruiterRepository $recruiterRepository,ICityRepository $cityRepository)
    {
        parent::__construct($seekerJobRepository);
        $this->jobRepository = $jobRepository;
          $this->positionRepository = $positionRepository;
          $this->companyImageRepository = $companyImageRepository;
          $this->transactionRepository = $transactionRepository;
          $this->recruiterRepository = $recruiterRepository;
          $this->cityRepository = $cityRepository;
    }

    public function index(Request $request)
    {
        $this->getDataShared();
        $jobs = $this->jobRepository->getJobRecruiterByPage($request,Auth::guard('recruiters')->user()->id,5);
        $positions = $this->positionRepository->getListPositions();
        $transactionNew = $this->transactionRepository->getTransactionNew(Auth::guard('recruiters')->user()->id);
        $viewData = [
             'jobs' => $jobs,
            'positions' => $positions,
            'transactionNew' => $transactionNew
        ];
        return view('recruiter::job.index',$viewData);    
    }

    public function getDetailJob($id){
        $this->getDataShared();
        $jobDetail = $this->jobRepository->getJobById($id);
        $imageCompanies = $this->companyImageRepository->getCompanyImageById($jobDetail->recruiter->id,'');
        $viewData = [
            'jobDetail' =>$jobDetail,
            'imageCompanies' => $imageCompanies
        ];
        return view('recruiter::job.detail',$viewData);
    }

    public function create(){
        $this->getDataShared();
        $positions = $this->positionRepository->getListPositions();
        $cities = $this->cityRepository->getListCities();
        $title = "Thêm mới";
        $viewData = [
            'positions' => $positions,
            'title' => $positions,
            'cities' => $cities
       ];

        return view('recruiter::job.create',$viewData);
    } 

    public function save($request, $id=''){
        try{
            $job = $this->jobRepository->saveJob($request,$id);
            return $job;
        }catch(\Exception $exception)
        {
            Log::error("[Error save Job ]".$exception);
            return false;
        }
    }
    public function createpost(RequestJob $request){
        $job = $this->save($request);
        if($job){
            $this->recruiterRepository->reducePostNumber($job->RecruiterId);
            return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Success ! Thêm mới thành công !','flash-level'=>'success']);}
        else{
            return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Danger ! Thêm mới thất bại !','flash-level'=>'danger']);
        }
    }

    public function edit($id){
        $this->getDataShared();
        $data['positions'] = $this->positionRepository->getListPositions();
        $data['title'] = "Cập nhật";
        $data['job'] = $this->jobRepository->getJobById($id);
        $data['cities'] = $this->cityRepository->getListCities();

        return view('recruiter::job.edit',$data);
    }

    public function update(RequestJob $request,$id)
    {
        if($this->save($request,$id)==1)
            return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Success ! Sửa thành công !','flash-level'=>'success']);
        else{
            return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Danger ! Sửa thất bại !','flash-level'=>'danger']);
        }
    }

    public function delete($id){
        $this->getDataShared();
        if($this->jobRepository->deleteJobById($id)==true)
            return redirect()->back()->with(['flash-message'=>'Success ! Xóa việc làm thành công !','flash-level'=>'success']);
        else{
            return redirect()->back()->with(['flash-message'=>'Danger ! Xóa việc làm thất bại !','flash-level'=>'danger']);
        }
    }


}
