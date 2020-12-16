<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestChangeInfo;
use App\Http\Requests\RequestChangePass;
use App\Http\Requests\RequestRegisterSeeker;
use App\Models\Job;
use App\Models\Seeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    //
    public function getJobApply(Request $request,$id)
    {
        $jobs = Job::with('recruiter:id,CompanyLogo')
                    ->join('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
                    ->where('seeker_jobs.SeekerId','=',Auth::guard('seekers')->user()->id);

        $jobs = $jobs->orderByDesc('jobs.JobId')->get();

        $viewData = [
            'jobs' => $jobs
        ];
        return view('user.list-job-apply',$viewData);
    }

    public function getChangeInfo($id)
    {
        return view('user.change-info');
    }

    public function postChangeInfo(RequestChangeInfo $registerSeeker,$id)
    {
        dd($registerSeeker->all());
        $seekerEdit = Seeker::find($id);
        $seekerEdit->SeekerName = $registerSeeker->SeekerName;
        $seekerEdit->Education = $registerSeeker->Education;
        $seekerEdit->email = $registerSeeker->Email;
        $seekerEdit->Address = $registerSeeker->Address;
        $seekerEdit->Phone = $registerSeeker->Phone;
        $seekerEdit->DateOfBirth = $registerSeeker->DateOfBirth;

        if(isset($registerSeeker->Avatar)){
            if($registerSeeker->hasFile('Avatar'))
            {
                $fileAvatar = $registerSeeker->file('Avatar');
                $file = upload_image($fileAvatar,$fileAvatar->getClientOriginalName());
                if(isset($file['name'])){
                    $seekerEdit->Avatar = $file['name'];
                }
            }
        }
        $seekerEdit->save();

        return redirect()->route('client.get.home.page');
    }

    public function getChangePassword($id)
    {
        return view('user.change-password');
    }

    public function postChangePassword(RequestChangePass $registerSeeker,$id)
    {
        if(Hash::check($registerSeeker->pass_old,get_data_user('seekers','password')))
        {
            $seekerChangePass = Seeker::find($id);
            $seekerChangePass->password = bcrypt($registerSeeker->pass_new);
            $seekerChangePass->save();
            Auth::guard('seekers')->logout();
            return redirect()->route('client.get.home.page');

            //return redirect()->back()->with('success','Cập nhật mất khẩu thành công!');

        }
        return redirect()->back()->with('danger','Mật khẩu cũ không đúng!');
    }
}
