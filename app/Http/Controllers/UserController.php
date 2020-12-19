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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    //
    public $jobRepository;
    public $seekerRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository, IPositionRepository $positionRepository, IJobRepository $jobRepository, ICityRepository $cityRepository, IRecruiterRepository $recruiterRepository, ISeekerRepository $seekerRepository)
    {
        parent::__construct($seekerJobRepository, $positionRepository, $jobRepository, $cityRepository, $recruiterRepository);

        $this->jobRepository = $jobRepository;
        $this->seekerRepository = $seekerRepository;
    }

    public function getJobApply($id)
    {
        $jobApplies = $this->jobRepository->getJobApplies($id);

        $viewData = [
            'jobApplies' => $jobApplies
        ];
        return view('user.list-job-apply',$viewData);
    }

    public function getChangeInfo($id)
    {
        return view('user.change-info');
    }

    public function postChangeInfo(RequestChangeInfo $registerSeeker,$id)
    {

        $this->seekerRepository->changeInfoSeeker($registerSeeker,$id);

        return redirect()->route('client.get.home.page');
    }

    public function getChangePassword($id)
    {
        return view('user.change-password');
    }

    public function postChangePassword(RequestChangePass $registerSeeker,$id)
    {
        if(Hash::check($registerSeeker->pass_old,get_data_user('seekers','password')))
        {
            Auth::guard('seekers')->logout();
            return redirect()->route('client.get.home.page');

            //return redirect()->back()->with('success','Cập nhật mất khẩu thành công!');

        }
        return redirect()->back()->with('danger','Mật khẩu cũ không đúng!');
    }
}
