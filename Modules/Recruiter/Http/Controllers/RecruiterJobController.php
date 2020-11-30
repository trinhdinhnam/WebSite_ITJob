<?php

namespace Modules\Recruiter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Job;
use App\Models\Position;
use App\Models\Language;
use App\Models\SeekerJob;

use App\Http\Requests\RequestJob;

class RecruiterJobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $jobs = Job::with('position:PositionId,PositionName')
                    ->where('RecruiterId',6)
                    ->get();
        // $seekerNumber = SeekerJob::select(SeekerJob::raw('COUNT(SeekerJobId) AS seekerNumber, JobId'))
        //             ->groupBy('JobId')->get();
        $viewData = [
             'jobs' => $jobs
            //  'seekerNumber' => $seekerNumber
        ];
        return view('recruiter::job.index',$viewData);    
    }

    public function getDetailJob(){
        return view('recruiter::job.index');    

    }

    public function create(){
        $positions = Position::all();
        $title = "Thêm mới";
        $viewData = [
            'positions' => $positions,
            'title' => $positions,
       ];

        return view('recruiter::job.create',$viewData);
    } 

    public function createpost(RequestJob $request){
         $job = new Job();
         $job->JobName = $request->JobName;
         $job->Require = $request->Require;
         $job->Description = $request->Description;
         $job->Address = $request->Address;
         $job->City = $request->City;
         $job->StartDateApply = $request->StartDateApply;
         $job->EndDateApply = $request->EndDateApply;
         $job->PositionId = $request->PositionId;
         $job->Skill = $request->Skill;
         $job->Salary = $request->Salary;
         $job->AdminID = 1;
         $job->RecruiterId = 6;
         $job->save();
         return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Success ! Thêm mới thành công !','flash-level'=>'success']);

    }

    public function edit($id){
        $data['positions'] = Position::all();
        $data['title'] = "Cập nhật";
        $data['job'] = Job::find($id);
        return view('recruiter::job.edit',$data);
    }

    public function update(RequestJob $request,$id)
    {
        $job = Job::find($id);
        $job->JobName = $request->JobName;
        $job->Require = $request->Require;
        $job->Description = $request->Description;
        $job->Address = $request->Address;
        $job->City = $request->City;
        $job->StartDateApply = $request->StartDateApply;
        $job->EndDateApply = $request->EndDateApply;
        $job->PositionId = $request->PositionId;
        $job->Skill = $request->Skill;
        $job->Salary = $request->Salary;
        $job->AdminID = 1;
        $job->RecruiterId = 6;
        $job->save();
        return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Success ! Thêm mới thành công !','flash-level'=>'success']);
    }

    public function delete($id){
        $job = Job::find($id);
        $job->IsDelete = $job->IsDelete ? 0 : 1;
        $job->save(); 
        return redirect()->back();   
    }

}
