<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Position;
use App\Models\Recruiter;
use App\Models\SeekerJob;
use App\Repository\City\ICityRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ApplyController extends BaseController
{
    //

    public $seekerJobRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository, IPositionRepository $positionRepository, IJobRepository $jobRepository, ICityRepository $cityRepository, IRecruiterRepository $recruiterRepository)
    {
        parent::__construct($seekerJobRepository, $positionRepository, $jobRepository, $cityRepository, $recruiterRepository);

        $this->seekerJobRepository = $seekerJobRepository;
    }

    public function getApply($id)
    {
        return view('apply.index');
    }

    public function postApply(Request $request,$id){

        $this->seekerJobRepository->addCVApply($request,$id);
        return redirect()->route('client.get.home.page')->with(['flash-message'=>'Success ! Ứng tuyển công việc thành công !','flash-level'=>'success']);
    }
}
