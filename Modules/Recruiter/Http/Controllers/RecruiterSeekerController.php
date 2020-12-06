<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Models\SeekerJob;
use App\Models\Seeker;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterSeekerController extends Controller
{
    public function getSeekerByJob($id){
        $seekerByJob = SeekerJob::with('seeker:id,SeekerName,Education,Email,Phone,Gender,Avatar')
            ->where('JobId',$id)
            ->where('IsDelete',1)
            ->get();
        $viewData = [
            'seekerByJobs' => $seekerByJob
        ];
        return view('recruiter::seeker.index',$viewData);
    }

    public function getSeekerDetail($id){
        $seekerDetail = SeekerJob::with('seeker:id,SeekerName,Education,Email,Phone,Gender,Avatar,Address,DateOfBirth')
                        ->where('SeekerJobId',$id)
                        ->first();

        $viewData = [
            'seekerDetail' => $seekerDetail
        ];
        return view('recruiter::seeker.detail',$viewData);

    }

    public function action($action,$id)
    {
        $seekerJob = SeekerJob::find($id);
        if($action){
            switch($action)
            {
                case 'status':
                    $seekerJob->Status = $seekerJob->Status ? 0 : 1;
                    $seekerJob->save();
                    break;
                case 'delete':
                    $seekerJob->IsDelete = $seekerJob->IsDelete ? 0 : 1;
                    $seekerJob->save();
                    break;
            }
        }
        return redirect()->back();
    }
}
