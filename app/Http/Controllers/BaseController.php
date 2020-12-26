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


    public function __construct(ISeekerJobRepository $seekerJobRepository,IPositionRepository $positionRepository, IJobRepository $jobRepository,
                                ICityRepository $cityRepository,IRecruiterRepository $recruiterRepository,ISkillRepository $skillRepository)
    {

        $positions = $positionRepository->getListPositions();
        View::share('positions',$positions);
        $jobNumber = count($jobRepository->getAllJob());
        View::share('jobNumber',$jobNumber);
        $cities = $cityRepository->getListCities();
        View::share('cities',$cities);
        $companies = $recruiterRepository->getAllRecruiter($request='');
        View::share('companyList',$companies);
        $messageNumber = $seekerJobRepository->getMessageNumber();
        View::share('messageNumber',$messageNumber);
        $messageInfos = $seekerJobRepository->getMessageInfo();
        View::share('messageInfos',$messageInfos);
        $skills = $skillRepository->getListSkills();
        View::share('skills',$skills);

    }
}
