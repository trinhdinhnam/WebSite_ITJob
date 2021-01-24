<?php

namespace Modules\Admin\Http\Controllers;

use App\Repository\BaseRepository;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Seeker\ISeekerRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminSeekerController extends AdminBaseController
{
    public $seekerRepository;
    public function __construct(IJobRepository $jobRepository,ISeekerRepository $seekerRepository, ITransactionRepository $transactionRepository)
    {
        parent::__construct($transactionRepository,$jobRepository);
        $this->seekerRepository = $seekerRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getSeeker()
    {
        $this->getDataShared();

        $seekers = $this->seekerRepository->getSeekerByPage(5);

        $viewData = [
            'seekers' => $seekers,
        ];
        return view('admin::seeker.index',$viewData);
    }


    public function action($action,$id)
    {
        $this->getDataShared();
            if($action){
                switch($action)
                {
                    case 'active':
                        if($this->seekerRepository->changeStatus($id)){
                            return redirect()->back()->with(['flash-message'=>'Success ! Bật hoạt động người tìm việc thành công !','flash-level'=>'success']);
                        }else{
                            return redirect()->back()->with(['flash-message'=>'Error ! Bật hoạt động người tìm việc thất bại !','flash-level'=>'danger']);
                        }
                    break;
                }
            }
    }

    public function getDetailSeeker($id){
        $this->getDataShared();
        $seekerDetail = $this->seekerRepository->getSeekerById($id);
        $viewData = [
            'seekerDetail' => $seekerDetail
        ];
        return view('admin::seeker.detail',$viewData);

    }
}
