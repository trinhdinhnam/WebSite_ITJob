<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Position;
use App\Models\Recruiter;
use App\Repository\City\ICityRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Skill\ISkillRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    //


    public $positionRepository;
    public $jobRepository;
    public $cityRepository;
    public $recruiterRepository;
    public $seekerJobRepository;
    public $skillRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository,IPositionRepository $positionRepository, IJobRepository $jobRepository,
                                ICityRepository $cityRepository,IRecruiterRepository $recruiterRepository,ISkillRepository $skillRepository)

    {
        $this->positionRepository = $positionRepository;
        $this->seekerJobRepository = $seekerJobRepository;
        $this->jobRepository = $jobRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->cityRepository = $cityRepository;
        $this->skillRepository = $skillRepository;
        $this->share();
    }
    public function share(){
        $positions = $this->positionRepository->getListPositions();
        View::share('positions',$positions);
        $cities = $this->cityRepository->getListCities();
        View::share('cities',$cities);
        $companies = $this->recruiterRepository->getAllRecruiter($request='');
        View::share('companyList',$companies);
        $messageNumber = $this->seekerJobRepository->getMessageNumber(get_data_user('seekers'));
        View::share('messageNumber',$messageNumber);
        $messageInfos = $this->seekerJobRepository->getMessageInfo(get_data_user('seekers'));
        View::share('messageInfos',$messageInfos);
        $skills = $this->skillRepository->getListSkills();
        View::share('skills',$skills);
    }

}
