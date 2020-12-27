<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\CompanyImage;
use App\Models\Job;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Recruiter;
use App\Models\Transaction;

class AdminRecruiterController extends Controller
{


    public $recruiterRepository;
    public $companyImageRepository;
    public function __construct(IRecruiterRepository $recruiterRepository, ICompanyImageRepository $companyImageRepository)
    {
        $this->recruiterRepository = $recruiterRepository;
        $this->companyImageRepository = $companyImageRepository;

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $recruiters = $this->recruiterRepository->getRecruiterByPage($request,5);
        $viewData = [
             'recruiters' => $recruiters
        ];
        return view('admin::recruiter.index', $viewData);
    }

    public function getDetailRecruiter($id){

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

        if($action){
            switch($action)
            {
                case 'active':
                    $this->recruiterRepository->changeActive($id);
                    return redirect()->back()->with(['flash-message'=>'Success ! Cập nhật trạng thái thành công !','flash-level'=>'success']);
                    break;
                case 'delete':
                    $this->recruiterRepository->deleteRecruiter($id);
                    return redirect()->back()->with(['flash-message'=>'Success ! Xóa nhà tuyển dụng thành công !','flash-level'=>'success']);
                    break;
            }
        }
        return redirect()->back();
    }


}