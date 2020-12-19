<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Http\Requests\RequestRegisterRecruiter;
use App\Models\AccountPackage;
use App\Models\City;
use App\Models\CompanyImage;
use App\Models\Job;
use App\Models\Recruiter;
use App\Repository\AccountPackage\IAccountPackageRepository;
use App\Repository\City\ICityRepository;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterAuthController extends Controller
{

    public $accountPackageRepository;
    public $cityRepository;
    public $recruiterRepository;
    public $companyImageRepository;
    public function __construct(IAccountPackageRepository $accountPackageRepository, ICityRepository $cityRepository, IRecruiterRepository $recruiterRepository, ICompanyImageRepository $companyImageRepository)

    {
        $this->accountPackageRepository = $accountPackageRepository;
        $this->cityRepository = $cityRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->companyImageRepository = $companyImageRepository;
    }

    public function getLoginUser(Request $request)
    {
        if($request->ajax()) {
            $html = view('recruiter::auth.login_modal')->render();
            return \response()->json($html);
        }
    }

    public function getLogin()
    {
        return view('recruiter::auth.login');

    }

    public function getAccountPackage(Request $request){
        $acPackages = $this->accountPackageRepository->getListAccountPackages();
        $viewData = [
            'acPackages' => $acPackages

        ];
        if($request->ajax()) {
            $html = view('recruiter::auth.account_package',$viewData)->render();
            return \response()->json($html);
        }
    }


    public function getSignUp()
    {
        $cities = $this->cityRepository->getListCities();
        $acPackages = $this->accountPackageRepository->getListAccountPackages();
        $viewData = [
            'cities' => $cities,
            'acPackages' => $acPackages
        ];
        return view('recruiter::auth.signup',$viewData);

    }

    public function submitRegister( RequestRegisterRecruiter $request){

        $recruiterId = $this->recruiterRepository->addRecruiter($request->only('RecruiterName','Position','Email','Phone','Password','CompanyName','Address','City','Country','Introduction','WorkDay','TimeWork','CompanySize','TypeBusiness','CompanyLogo'));

        $this->companyImageRepository->addCompanyImage($request->only('Image'),$recruiterId);

        return redirect()->route('recruiter.account.package')->with(['flash-message'=>'Success ! Đăng ký thành công !','flash-level'=>'success']);
    }


}
