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
use Illuminate\Support\Facades\Auth;

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
        if(Auth::guard('recruiters')->check())
        {
            return redirect()->route('recruiter.home');

        }else{
            return view('recruiter::auth.login');

        }
    }

    public function postLogin(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::guard('recruiters')->attempt($credentials)){
            return redirect()->route('recruiter.home');
        }
        return redirect()->back();
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

        $recruiterId = $this->recruiterRepository->addRecruiter($request);

        $this->companyImageRepository->addCompanyImage($request,$recruiterId);

        return view('recruiter::auth.login');
    }

    public function getLogout(){
        Auth::guard('recruiters')->logout();
        return redirect()->route('client.get.home.page');
    }


}
