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
    public function index()
    {
        $recruiters = $this->recruiterRepository->getAllRecruiter();
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
                break;
                case 'delete':
                    $this->recruiterRepository->deleteRecruiter($id);
                break;
            }
        }
        return redirect()->back();
    }


}