<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Models\SeekerJob;
use App\Models\Seeker;

use App\Repository\SeekerJob\ISeekerJobRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterSeekerController extends Controller
{

    public $seekerJobRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository)
    {
        $this->seekerJobRepository = $seekerJobRepository;

    }

    public function getSeekerByJob($id){

        $seekerByJob = $this->seekerJobRepository->getSeekerByJob($id);
        $viewData = [
            'seekerByJobs' => $seekerByJob
        ];
        return view('recruiter::seeker.index',$viewData);
    }

    public function getSeekerDetail($id){
        $seekerDetail = $this->seekerJobRepository->getSeekerDetail($id);

        $viewData = [
            'seekerDetail' => $seekerDetail
        ];
        return view('recruiter::seeker.detail',$viewData);

    }

    public function action($action,$id)
    {
        if($action){
            switch($action)
            {
                case 'status':
                    $this->seekerJobRepository->changeStatusById($id);
                    break;
                case 'delete':
                    $this->seekerJobRepository->deleteSeekerJobById($id);
                    break;
            }
        }
        return redirect()->back();
    }
}
