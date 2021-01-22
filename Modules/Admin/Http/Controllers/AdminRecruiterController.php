<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\CompanyImage;
use App\Models\Job;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Recruiter;
use App\Models\Transaction;

class AdminRecruiterController extends AdminBaseController
{


    public $recruiterRepository;
    public $companyImageRepository;
    public function __construct(IRecruiterRepository $recruiterRepository, ICompanyImageRepository $companyImageRepository, IJobRepository $jobRepository,ITransactionRepository $transactionRepository)
    {
        parent::__construct($transactionRepository,$jobRepository);
        $this->recruiterRepository = $recruiterRepository;
        $this->companyImageRepository = $companyImageRepository;

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $this->getDataShared();

        $recruiters = $this->recruiterRepository->getRecruiterByPage($request,5);
        $viewData = [
             'recruiters' => $recruiters
        ];
        return view('admin::recruiter.index', $viewData);
    }

    public function getDetailRecruiter($id){
        $this->getDataShared();

        $imageCompanies = $this->companyImageRepository->getCompanyImageById($id,'');
        $recruiterDetail = $this->recruiterRepository->getRecruiterById($id);
        $viewData = [
            'recruiterDetail' =>$recruiterDetail,
            'imageCompanies' => $imageCompanies
        ];
        return view('admin::recruiter.detail',$viewData);
    }
    
    public function action($action,$id)
    {
        $this->getDataShared();

        if($action){
            switch($action)
            {
                case 'active':
                    try{
                        $this->recruiterRepository->changeActive($id);
                        return redirect()->back()->with(['flash-message'=>'Success ! Cập nhật trạng thái thành công !','flash-level'=>'success']);

                    }catch (\Exception $e)
                    {
                        return redirect()->back()->with(['flash-message'=>'Error ! Cập nhật trạng thái thất bại !','flash-level'=>'danger']);
                    }
                    break;
                case 'delete':
                    try{
                        $this->recruiterRepository->deleteRecruiter($id);
                        return redirect()->back()->with(['flash-message'=>'Success ! Xóa nhà tuyển dụng thành công !','flash-level'=>'success']);

                    }catch (\Exception $e)
                    {
                        return redirect()->back()->with(['flash-message'=>'Error ! Xóa nhà tuyển dụng thất bại !','flash-level'=>'danger']);
                    }
                    break;
            }
        }
        return redirect()->back();
    }


}