<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestApply;
use App\Models\City;
use App\Models\Position;
use App\Models\Recruiter;
use App\Models\SeekerJob;
use App\Repository\City\ICityRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Seeker\ISeekerRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Skill\ISkillRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class ApplyController extends BaseController
{
    //

    public $seekerJobRepository;
    public $seekerRepository;

    public function __construct(ISeekerJobRepository $seekerJobRepository,IPositionRepository $positionRepository, IJobRepository $jobRepository,
                                ICityRepository $cityRepository,IRecruiterRepository $recruiterRepository,ISkillRepository $skillRepository, ISeekerRepository $seekerRepository)
    {
        parent::__construct($seekerJobRepository, $positionRepository, $jobRepository, $cityRepository, $recruiterRepository,$skillRepository);

        $this->seekerJobRepository = $seekerJobRepository;
        $this->seekerRepository = $seekerRepository;
    }

    public function getApply($id)
    {
        $this->share();

        return view('apply.index');
    }

    public function postApply(RequestApply $request,$id){
        $this->share();
        $seekerJob = $this->seekerJobRepository->addCVApply($request,$id);
        if($seekerJob){
            $data['seekerName'] = $seekerJob->SeekerName;
            $data['seekerJobId'] = $seekerJob->SeekerJobId;
            $data['applyDate'] = $seekerJob->created_at;
            $data['seekerPhone'] = $seekerJob->SeekerPhone;
            $data['seekerAddress'] = $seekerJob->SeekerAddress;
            $data['CV'] = $seekerJob->CVLink;
            $data['Status'] = $seekerJob->Status;
            $job = $this->jobRepository->getJobById($seekerJob->JobId);
            $recruiter = $this->recruiterRepository->getRecruiterById($job->RecruiterId);
            $data['recruiter'] = $recruiter;
            $data['job'] = $job;
            $this->sendMail($data);
            return redirect()->route('client.get.home.page')->with(['flash-message'=>'Success ! Ứng tuyển việc làm thành công !','flash-level'=>'success']);
        }
        else{
            return redirect()->route('client.get.detail.job',$id)->with(['flash-message'=>'Fail ! Ứng tuyển việc làm thất bại !','flash-level'=>'danger']);
        }
    }

    public function sendMail($data){
        Mail::send('email.apply',$data,function($message){
            $message->from('phuongnamrecruiment.edu.vn@gmail.com','PhuongNam Recruiment');
            $message->to('trinhkiet17898@gmail.com','Trịnh Kiệt');
            $message->subject('Thư gửi xác nhận ứng tuyển thành công');
        });
    }

    public function getSendMail(){
        return view('email.apply');
    }
}
