<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Http\Requests\RequestChangeInfoRecruiter;
use App\Http\Requests\RequestChangePassRecruiter;
use App\Http\Requests\RequestRegisterRecruiter;
use App\Repository\AccountPackage\IAccountPackageRepository;
use App\Repository\City\ICityRepository;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RecruiterUserController extends Controller
{
    public $cityRepository;
    public $accountPackageRepository;
    public $companyImageRepository;
    public $recruiterRepository;
    public function __construct(ICityRepository $cityRepository, IAccountPackageRepository $accountPackageRepository,ICompanyImageRepository $companyImageRepository,IRecruiterRepository $recruiterRepository)
    {
         $this->cityRepository = $cityRepository;
         $this->accountPackageRepository = $accountPackageRepository;
         $this->companyImageRepository = $companyImageRepository;
         $this->recruiterRepository = $recruiterRepository;
    }

    public function getChangeInfo($id){
        $cities = $this->cityRepository->getListCities();
        $acPackages = $this->accountPackageRepository->getListAccountPackages();
        $imageCompanies = $this->companyImageRepository->getCompanyImageById($id,'');

        $viewData = [
            'cities' => $cities,
            'acPackages' => $acPackages,
            'imageCompanies' => $imageCompanies

        ];
        return view('recruiter::auth.change-info',$viewData);
    }

    public function postChangeInfo(Request $request, $id){

        //dd($request->all());
        $this->recruiterRepository->changInfoRecruiter($request,$id);

        //$this->companyImageRepository->changeImageCompany($request,$id);

        return redirect()->route('recruiter.home');
    }

    public function getChangePassword($id){

        return view('recruiter::auth.change-password');

    }

    public function postChangePassword(RequestChangePassRecruiter $requestChangePassRecruiter,$id){
        if(Hash::check($requestChangePassRecruiter->pass_old,get_data_user('recruiters','password')))
        {
            $this->recruiterRepository->changePassRecruiter($requestChangePassRecruiter->only('pass_new'),$id);
            Auth::guard('recruiters')->logout();
            return redirect()->route('client.get.home.page')->with(['flash-message'=>'Success ! Cập nhật mật khẩu thành công !','flash-level'=>'success']);

            //return redirect()->back()->with('success','Cập nhật mất khẩu thành công!');

        }
        return redirect()->back()->with(['flash-message'=>'Error ! Mật khẩu cũ không đúng!','flash-level'=>'danger']);
    }
}
