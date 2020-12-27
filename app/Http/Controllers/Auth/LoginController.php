<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestRegisterSeeker;
use App\Models\Seeker;
use App\Repository\Seeker\ISeekerRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public $seekerRepository;

    public function __construct(ISeekerRepository $seekerRepository)
    {
        $this->seekerRepository = $seekerRepository;
    }

    public function getLogin(Request $request){

        if($request->ajax()) {
            $html = view('Auth.login')->render();
            return \response()->json($html);
        }
    }

    public function postLogin(Request $request){

        $credentials = $request->only('email','password');

        if(Auth::guard('seekers')->attempt($credentials)) {
            if(Auth::guard('seekers')->user()->Active==1){
                $seeker = Auth::guard('seekers')->user()->SeekerName;
                $viewData = [
                    'seeker' => $seeker
                ];
                 return redirect()->route('client.get.home.page', $viewData)->with(['flash-message' => 'Success ! Đăng nhập thành công !', 'flash-level' => 'success']);
            }
            else{
             return redirect()->route('seeker.get.login')->with(['flash-message'=>'Error ! Tài khoản của bạn đã hết hiệu lực !','flash-level'=>'error']);
            }
        }
        return redirect()->route('seeker.get.login');
    }

    public function getLogout(){
        Auth::guard('seekers')->logout();
        return redirect()->route('client.get.home.page');
    }

    public function getRegister(){
        return view('Auth.register');
    }

    public function postRegister(RequestRegisterSeeker $request)
    {
        try{
            $this->seekerRepository->addSeeker($request);
            return redirect()->route('seeker.get.login');

        }catch (\Exception $e){
            return redirect()->route('seeker.get.register');
        }
    }

    public function getLoginByFacebook($social){
        return Socialite::driver($social)->redirect();
    }

    public function checkLoginByFacebook($social){

        $info = Socialite::driver($social)->user();
        dd($info);
    }
}
