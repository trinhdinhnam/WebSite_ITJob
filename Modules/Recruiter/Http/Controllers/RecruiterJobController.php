<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Job\JobRepository;
use App\Repository\Position\IPositionRepository;
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

class RecruiterJobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public $jobRepository;
    public $positionRepository;
    public $companyImageRepository;
    public function __construct(IJobRepository $jobRepository, IPositionRepository $positionRepository, ICompanyImageRepository $companyImageRepository)
    {
          $this->jobRepository = $jobRepository;
          $this->positionRepository = $positionRepository;
          $this->companyImageRepository = $companyImageRepository;
    }

    public function index()
    {
        $jobs = $this->jobRepository->getJobByRecruiterId(6);
        $viewData = [
             'jobs' => $jobs
        ];
        return view('recruiter::job.index',$viewData);    
    }

    public function getDetailJob($id){

        $jobDetail = $this->jobRepository->getJobById($id);
        $imageCompanies = $this->companyImageRepository->getCompanyImageById($jobDetail->recruiter->id,'');
        $viewData = [
            'jobDetail' =>$jobDetail,
            'imageCompanies' => $imageCompanies
        ];
        return view('recruiter::job.detail',$viewData);
    }

    public function create(){
        $positions = $this->positionRepository->getListPositions();
        $title = "Thêm mới";
        $viewData = [
            'positions' => $positions,
            'title' => $positions,
       ];

        return view('recruiter::job.create',$viewData);
    } 

    public function save($request, $id=''){
        $code = 1;
        try{
             $this->jobRepository->saveJob($request,$id);

        }catch(\Exception $exception)
        {
            $code=0;
            Log::error("[Error save Job ]".$exception);
        }
        return $code;
    }
    public function createpost(RequestJob $request){
        $this->save($request);
         return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Success ! Thêm mới thành công !','flash-level'=>'success']);

    }

    public function edit($id){
        $data['positions'] = $this->positionRepository->getListPositions();
        $data['title'] = "Cập nhật";
        $data['job'] = $this->jobRepository->getJobById($id);
        return view('recruiter::job.edit',$data);
    }

    public function update(RequestJob $request,$id)
    {
        $this->save($request,$id);
        return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Success ! Thêm mới thành công !','flash-level'=>'success']);
    }

    public function delete($id){
        $this->jobRepository->deleteJobById($id);
        return redirect()->back();   
    }


}
