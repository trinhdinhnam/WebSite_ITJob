<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Models\SeekerJob;
use App\Models\Seeker;

use App\Repository\SeekerJob\ISeekerJobRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterSeekerController extends RecruiterBaseController
{

    public $seekerJobRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository)
    {
        parent::__construct($seekerJobRepository);
        $this->seekerJobRepository = $seekerJobRepository;

    }

    public function getSeekerByJob($id){
        $this->getDataShared();

        $seekerByJob = $this->seekerJobRepository->getSeekerByJob($id);
        $viewData = [
            'seekerByJobs' => $seekerByJob
        ];
        return view('recruiter::seeker.index',$viewData);
    }

    public function getSeekerDetail($id){
        $this->getDataShared();

        $seekerDetail = $this->seekerJobRepository->getSeekerDetail($id);

        $viewData = [
            'seekerDetail' => $seekerDetail
        ];
        return view('recruiter::seeker.detail',$viewData);

    }

    public function action($action,$id)
    {
        $this->getDataShared();

        if($action){
            switch($action)
            {
                case 'status':
                    try{
                        $this->seekerJobRepository->changeStatusById($id);
                        return redirect()->back()->with(['flash-message'=>'Success ! Duyệt ứng viên thành công !','flash-level'=>'success']);

                    }catch (\Exception $e){
                        return redirect()->back()->with(['flash-message'=>'Error ! Duyệt ứng viên thất bại !','flash-level'=>'danger']);
                    }
                    break;
                case 'delete':
                    try{
                        $this->seekerJobRepository->deleteSeekerJobById($id);
                        return redirect()->back()->with(['flash-message'=>'Success ! Xóa ứng viên thành công !','flash-level'=>'success']);

                    }catch (\Exception $e){
                        return redirect()->back()->with(['flash-message'=>'Error ! Xóa ứng viên thất bại !','flash-level'=>'danger']);
                    }
                    break;
            }
        }
        return redirect()->back();
    }
}
