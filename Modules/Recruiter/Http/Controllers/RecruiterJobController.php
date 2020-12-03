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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RecruiterJobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $jobs = DB::table('jobs')
               ->select(DB::raw('count(SeekerJobId) as seekerNumber, jobs.JobId as JobId, JobName, PositionName, Skill, jobs.Status as Status, Address'))
               ->leftJoin('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
               ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
            ->where('RecruiterId',6)
            ->where('jobs.IsDelete',1)
            ->groupBy('JobId','JobName','PositionName','Skill','jobs.Status','Address')
            ->get();


        //$jobs = Job::with('position:PositionId,PositionName')
        //            ->where('RecruiterId',6)
          //          ->where('IsDelete',1)
            //        ->get();
        //$seekerNumber = DB::table('seeker_jobs')
              //          ->select(DB::raw('count(*) as seekerNumber, JobId'))
                //        ->groupBy('JobId')
                  //      ->get();
        $viewData = [
             'jobs' => $jobs

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

    public function save($request, $id=''){
        $code = 1;
        try{
            $job = new Job();

            if($id){
                $job = Job::find($id);
            }
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

        }catch(\Exception $exception)
        {
            $code=0;
            Log::error("[Error save Job ]".$exception);
        }
        return $code;
    }
    public function createpost(RequestJob $request){
        $this->save($request);
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
        $this->save($request,$id);
        return redirect()->route('recruiter.get.list.job')->with(['flash-message'=>'Success ! Thêm mới thành công !','flash-level'=>'success']);
    }

    public function delete($id){
        $job = Job::find($id);
        $job->IsDelete = $job->IsDelete ? 0 : 1;
        $job->save(); 
        return redirect()->back();   
    }

    public function getSeekerByJob($id){
        $seekerByJob = SeekerJob::with('seeker:id,SeekerName,Education,Email,Phone,Gender,Avatar')
                     ->where('JobId',$id)
                     ->get();
        $viewData = [
            'seekerByJobs' => $seekerByJob
        ];
        return view('recruiter::seeker.index',$viewData);
    }

}
