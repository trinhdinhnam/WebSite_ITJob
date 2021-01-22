<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestChangeInfo;
use App\Http\Requests\RequestChangePass;
use App\Http\Requests\RequestRegisterSeeker;
use App\Models\Job;
use App\Models\Seeker;
use App\Repository\City\ICityRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Seeker\ISeekerRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Skill\ISkillRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    //
    public $jobRepository;
    public $seekerRepository;
    public $seekerJobRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository, IPositionRepository $positionRepository, IJobRepository $jobRepository, ICityRepository $cityRepository, IRecruiterRepository $recruiterRepository, ISeekerRepository $seekerRepository,ISkillRepository $skillRepository)
    {
        parent::__construct($seekerJobRepository, $positionRepository, $jobRepository, $cityRepository, $recruiterRepository,$skillRepository);

        $this->jobRepository = $jobRepository;
        $this->seekerRepository = $seekerRepository;
        $this->seekerJobRepository = $seekerJobRepository;
    }

    public function getJobApply($id)
    {
        $this->share();

        $jobApplies = $this->jobRepository->getJobApplies($id);

        $viewData = [
            'jobApplies' => $jobApplies
        ];
        return view('user.list-job-apply',$viewData);
    }

    public function getProfileDetail($seekerJobId){
        $this->share();

        $seekerJob = $this->seekerJobRepository->getSeekerJobById($seekerJobId);
        $viewData = [
            'seekerJob' => $seekerJob
        ];
        return view('user.profile-detail',$viewData);

    }

    public function getChangeInfo($id)
    {
        $this->share();

        return view('user.change-info');
    }

    public function postChangeInfo(RequestChangeInfo $registerSeeker,$id)
    {
        $this->share();


        if($this->seekerRepository->changeInfoSeeker($registerSeeker,$id)==true){
            return redirect()->route('client.get.home.page')->with(['flash-message'=>'Success ! Cập nhật thông tin thành công!','flash-level'=>'success']);
        }else{
            return redirect()->back()->with(['flash-message'=>'Error ! Cập nhật thông tin thất bại!','flash-level'=>'danger']);
        }

    }

    public function getChangePassword($id)
    {
        $this->share();

        return view('user.change-password');
    }

    public function postChangePassword(RequestChangePass $registerSeeker,$id)
    {
        $this->share();

        if(Hash::check($registerSeeker->pass_old,get_data_user('seekers','password')))
        {
            Auth::guard('seekers')->logout();
            return redirect()->route('client.get.home.page')->with(['flash-message'=>'Success ! Cập nhật mật khẩu thành công!','flash-level'=>'success']);

            //return redirect()->back()->with('success','Cập nhật mất khẩu thành công!');

        }
        return redirect()->back()->with(['flash-message'=>'Error ! Cập nhật mật khẩu thất bại!','flash-level'=>'danger']);
    }
}
