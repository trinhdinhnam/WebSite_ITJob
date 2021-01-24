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

    public function getLogin(Request $request)
    {

        if ($request->ajax()) {
            $html = view('Auth.login')->render();
            return \response()->json($html);
        }
    }

    public function postLogin(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('seekers')->attempt($credentials)) {
            if (Auth::guard('seekers')->user()->Active == 1) {
                $seeker = Auth::guard('seekers')->user()->SeekerName;
                $viewData = [
                    'seeker' => $seeker
                ];
                return redirect()->route('client.get.home.page', $viewData)->with(['flash-message' => 'Success ! Đăng nhập thành công !', 'flash-level' => 'success']);
            } else {
                Auth::guard('seekers')->logout();
                return redirect()->route('client.get.home.page')->with(['flash-message' => 'Error ! Tài khoản của bạn đã hết hiệu lực !', 'flash-level' => 'danger']);
            }
        }
        return redirect()->route('client.get.home.page')->with(['flash-message' => 'Error ! Đăng nhập thất bại !', 'flash-level' => 'danger']);
    }

    public function getLogout()
    {
        Auth::guard('seekers')->logout();
        return redirect()->route('client.get.home.page');
    }

    public function getRegister()
    {
        return view('Auth.register');
    }

    public function postRegister(RequestRegisterSeeker $request)
    {
        try {
            $this->seekerRepository->addSeeker($request);
            return redirect()->route('client.get.home.page')->with(['flash-message' => 'Success ! Đăng ký thành công !', 'flash-level' => 'success']);
        } catch (\Exception $e) {
            return redirect()->route('seeker.get.register')->with(['flash-message' => 'Success ! Đăng ký thành công !', 'flash-level' => 'success']);
        }
    }

    public function getLoginByFacebook($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function checkLoginByFacebook($social)
    {

        $info = Socialite::driver($social)->user();
        $user = $this->createUser($info, $social);
        \auth()->login($user);
        return redirect()->to('/');

    }

    public function createUser($getInfo, $provider)
    {
        $seeker = Seeker::where('provider_id', $getInfo->id)->first();
        dd($seeker);
        //if(!$seeker){
        //    $seeker = Seeker::insert([
        //       'SeekerName' => $getInfo->name,
        //        'email' => $getInfo->email,
        //        'provider' => $provider,
        //        'provider_id' => $getInfo->id
        //    ]);
        //}

        //return $seeker;
    }

    public function getLoginByGoogle($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function checkLoginByGoogle($social){
        try{
            $user = Socialite::driver($social)->user();
        }catch (\Exception $e){
            return redirect('/');
        }

        if(explode("@",$user->email)[1] != 'gmail.com'){
            return redirect('/');
        }

        $existingUser = Seeker::where('email',$user->email)->first();
        if($existingUser){
            Auth::guard('seekers')->login($existingUser,true);
        }else{
            $newSeeker = new Seeker;
            $newSeeker->SeekerName = $user->name;
            $newSeeker->email = $user->email;
            $newSeeker->google_id = $user->id;
            $newSeeker->Avatar = $user->avatar;
            $newSeeker->save();
            Auth::guard('seekers')->login($newSeeker,true);
        }
        return redirect('/');
    }
}
