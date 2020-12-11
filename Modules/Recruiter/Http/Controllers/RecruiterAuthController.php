<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Http\Requests\RequestRegisterRecruiter;
use App\Models\AccountPackage;
use App\Models\City;
use App\Models\CompanyImage;
use App\Models\Job;
use App\Models\Recruiter;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterAuthController extends Controller
{

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
        $acPackages = AccountPackage::all();
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
        $cities = City::all();
        $acPackages = AccountPackage::all();
        $viewData = [
            'cities' => $cities,
            'acPackages' => $acPackages
        ];
        return view('recruiter::auth.signup',$viewData);

    }

    public function submitRegister( RequestRegisterRecruiter $request){
        $recruiter = new Recruiter();
        $recruiter->RecruiterName = $request->RecruiterName;
        $recruiter->Position = $request->Position;
        $recruiter->Email = $request->Email;
        $recruiter->Phone = $request->Phone;
        $recruiter->Password = bcrypt($request->Password);
        $recruiter->CompanyName = $request->CompanyName;
        $recruiter->Address = $request->Address;
        $recruiter->CityId = $request->City;
        $recruiter->Country = $request->Country;
        $recruiter->Introduction = $request->Introduction;
        $recruiter->WorkDay = $request->WorkDay;
        $recruiter->TimeWork = $request->TimeWork;
        $recruiter->CompanySize = $request->CompanySize;
        $recruiter->TypeBusiness = $request->TypeBusiness;
        if($request->hasFile('CompanyLogo'))
        {
            $fileCompanyLogo = $request->file('CompanyLogo');
            $fileLogo = upload_image($fileCompanyLogo,$fileCompanyLogo->getClientOriginalName());
            if(isset($fileLogo['name'])){
                $recruiter->CompanyLogo = $fileLogo['name'];
            }
        }
        $recruiter->save();

        if ($request->hasFile('Image')){
            $arrayImage = $request->file('Image');
           foreach ($arrayImage as $file){
               $fileImage = upload_image($file,$file->getClientOriginalName());
               $company_img = new CompanyImage();
               if(isset($fileImage['name'])){
                   $company_img->Image = $fileImage['name'];
                   $company_img->RecruiterId = $recruiter->id;
                   $company_img->save();
               }
           }
        }
        return redirect()->route('recruiter.account.package')->with(['flash-message'=>'Success ! Đăng ký thành công !','flash-level'=>'success']);
    }


}
