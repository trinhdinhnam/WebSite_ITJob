<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Repository\City\ICityRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Skill\ISkillRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class RecruiterBaseController extends Controller
{
    public $seekerJobRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository)
    {
         $this->seekerJobRepository = $seekerJobRepository;
    }
    public function getDataShared(){
        $messageApply = $this->seekerJobRepository->getSeekerByRecruiter(get_data_user('recruiters','id'),'');
        View::share('messageApply',$messageApply);
        $messageNumber =  count($messageApply->where('MessageApplyStatus','=',0));
        View::share('messageNumber',$messageNumber);

    }

}
