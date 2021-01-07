<?php
namespace App\Repository\Job;
use App\Models\Job;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class JobRepository extends BaseRepository implements IJobRepository
{
    public function model(){
        return Job::class;
    }

    public function getJobById($id)
    {
        // TODO: Implement getJobById() method.
        $query = $this->model
            ->with('recruiter:id,CompanyName,Introduction,TypeBusiness,CompanySize,Address,TimeWork,WorkDay,CompanyLogo')
            ->with('seekerJob:SeekerJobId,JobId,SeekerId')
            ->where('jobs.JobId',$id)
            ->first();
        return $query;
    }

    public function getJobByRecruiterId($request,$id){
        // TODO: Implement getJobByRecruiterId() method.
        $query = $this->model
            ->select(DB::raw('COUNT(SeekerJobId) as seekerNumber'), 'jobs.JobId as JobId','jobs.Description as Description',
                'JobName', 'PositionName', 'Skill', 'jobs.Status as Status', 'jobs.created_at as CreatedDate',
                'recruiters.CompanyLogo as CompanyLogo', 'recruiters.Address as Address','jobs.Benifit as Benifit',
                'jobs.Salary as Salary','cities.CityName as City','jobs.StartDateApply as StartDateApply','jobs.EndDateApply as EndDateApply')
            ->leftJoin('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
            ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
            ->leftJoin('cities','jobs.CityId','=','cities.CityId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->where('RecruiterId',$id)
            ->where('jobs.IsDelete',1)
            ->groupBy('JobId','JobName','PositionName', 'Skill','jobs.Status','Address', 'jobs.created_at','CompanyLogo','Salary','Benifit','City','Description','StartDateApply','EndDateApply');
            if($request){
            if($request->jobname) $query->where('JobName', 'like', '%'.$request->jobname.'%');
            if($request->position) $query->where('jobs.PositionId',$request->position);
        }
            $query = $query->get();
            return $query;
    }


    public function saveJob($jobInput, $id)

    {
        // TODO: Implement saveJob() method.
        $job = new $this->model;
        if($id){
            $job = $this->model::find($id);
        }
        $job->JobName = $jobInput->JobName;
        $job->Require = $jobInput->Require;
        $job->Description = $jobInput->Description;
        $job->Address = $jobInput->Address;
        $job->CityId = $jobInput->City;
        $job->StartDateApply = $jobInput->StartDateApply;
        $job->EndDateApply = $jobInput->EndDateApply;
        $job->PositionId = $jobInput->PositionId;
        $job->Skill = $jobInput->Skill;
        $job->Salary = $jobInput->Salary;
        $job->Benifit = $jobInput->Benefit;
        $job->AdminID = 1;
        $job->RecruiterId = Auth::guard('recruiters')->user()->id;
        $job->save();
    }

    public function deleteJobById($id)
    {
        // TODO: Implement deleteJobById() method.
        try{
            $job = $this->model::find($id);
            $job->IsDelete = $job->IsDelete ? 0 : 1;
            $job->save();
            return true;
        }catch (\Exception $exception)
        {
            return false;
        }

    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getListJobs($request,$actor)
    {
        // TODO: Implement getListJobs() method.

        if($actor=='client')
        {
            $jobs = $this->model
                ->select(DB::raw('COUNT(SeekerJobId) as seekerNumber'), 'jobs.JobId as JobId', 'JobName',
                    'PositionName', 'Skill', 'jobs.Status as Status', 'jobs.created_at as CreatedDate',
                    'recruiters.CompanyLogo as CompanyLogo', 'recruiters.Address as Address','jobs.Benifit as Benifit',
                    'jobs.Salary as Salary','cities.CityName as City','jobs.Description as Description' ,'jobs.EndDateApply as EndDateApply')
                ->leftJoin('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
                ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
                ->leftJoin('cities','jobs.CityId','=','cities.CityId')
                ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id');
            if($request->skillname) $jobs->where('Skill', 'like', '%'.$request->skillname.'%');
            if($request->City) $jobs->where('CityId',$request->City);
            $jobs = $jobs->groupBy('JobId','JobName','PositionName', 'Skill','jobs.Status','Address', 'jobs.created_at','CompanyLogo','Salary','Benifit','City','Description','EndDateApply')
                         ->where('jobs.IsDelete','=',1)
                         -> orderByDesc('JobId')
                         ->get();
        }
        if($actor=='admin')
        {
            $jobs = $this->model->with('position:PositionId,PositionName');
            if($request){
                if($request->jobname) $jobs->where('JobName', 'like', '%'.$request->jobname.'%');
                if($request->recruiter) $jobs->where('RecruiterId',$request->recruiter);
            }
            $jobs = $jobs->orderByDesc('JobId')->get();
        }
        if($actor=='recruiter')
        {
            $jobs = $this->model->with('position:PositionId,PositionName');
            $jobs = $jobs->orderByDesc('JobId')->get();
        }

        return $jobs;
    }

    public function getAllJob()
    {
        // TODO: Implement getAllJob() method.

        return $this->model->with('recruiter:id,CompanyName')->with('position:PositionId,PositionName')->get();
    }

    public function getJobsByCompanyHot($recruiterId, $limit)
    {
        // TODO: Implement getJobNumberByCompanyHot() method.
        $jobByCompanyHot = $this->model
            ->select('JobName','JobId','StartDateApply','EndDateApply')
            ->where('RecruiterId',$recruiterId);
        if($limit > 0)
        {
            $jobByCompanyHot = $jobByCompanyHot->limit($limit);
        }

        $jobByCompanyHot = $jobByCompanyHot->orderBy('created_at','desc')
            ->get();
        return $jobByCompanyHot;
    }

    public function getJobApplies($seekerId)
    {
        // TODO: Implement getJobApplies() method.
        $jobApplies = $this->model
            ->select(DB::raw('COUNT(SeekerJobId) as seekerNumber'), 'jobs.JobId as JobId', 'JobName',
                'PositionName', 'Skill', 'seeker_jobs.Status as Status', 'jobs.created_at as CreatedDate',
                'recruiters.CompanyLogo as CompanyLogo', 'recruiters.Address as Address','jobs.Benifit as Benifit',
                'jobs.Salary as Salary','cities.CityName as City','seeker_jobs.CVLink as CVLink',
                'seeker_jobs.created_at as ApplyDate','jobs.Description as Description')
            ->join('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
            ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
            ->leftJoin('cities','jobs.CityId','=','cities.CityId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->groupBy('JobId','JobName','PositionName', 'Skill','Status','Address', 'jobs.created_at','CompanyLogo','Salary','Benifit','City','Description','CVLink','ApplyDate')
            ->where('jobs.IsDelete','=',1)
            ->where('seeker_jobs.SeekerId',$seekerId)
            ->orderByDesc('seeker_jobs.created_at')
            ->get();
        return $jobApplies;
    }

    public function getJobByPositions($positionId)
    {
        // TODO: Implement getJobByPositions() method.
        $jobByPositions = $this->model
            ->select(DB::raw('COUNT(SeekerJobId) as seekerNumber'), 'jobs.JobId as JobId', 'JobName',
                'PositionName', 'Skill', 'jobs.Status as Status', 'jobs.created_at as CreatedDate',
                'recruiters.CompanyLogo as CompanyLogo', 'recruiters.Address as Address','jobs.Benifit as Benifit',
                'jobs.Salary as Salary','cities.CityName as City','jobs.Description as Description','jobs.EndDateApply as EndDateApply' )
            ->leftJoin('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
            ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
            ->leftJoin('cities','jobs.CityId','=','cities.CityId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->groupBy('JobId','JobName','PositionName', 'Skill','jobs.Status','Address', 'jobs.created_at','CompanyLogo','Salary','Benifit','City','Description','EndDateApply')
            ->where('jobs.IsDelete','=',1)
            ->where('jobs.PositionId',$positionId)
            ->get();

        return $jobByPositions;
    }

    public function getJobByCities($cityId)
    {
        // TODO: Implement getJobByCities() method.
        $jobByCities = $this->model
            ->select(DB::raw('COUNT(SeekerJobId) as seekerNumber'), 'jobs.JobId as JobId', 'JobName',
                'PositionName', 'Skill', 'jobs.Status as Status', 'jobs.created_at as CreatedDate',
                'recruiters.CompanyLogo as CompanyLogo', 'recruiters.Address as Address','jobs.Benifit as Benifit',
                'jobs.Salary as Salary','cities.CityName as City','jobs.Description as Description','jobs.EndDateApply as EndDateApply' )
            ->leftJoin('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
            ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
            ->leftJoin('cities','jobs.CityId','=','cities.CityId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->groupBy('JobId','JobName','PositionName', 'Skill','jobs.Status','Address', 'jobs.created_at','CompanyLogo','Salary','Benifit','City','Description','EndDateApply')
            ->where('jobs.IsDelete','=',1)
            ->where('jobs.CityId',$cityId)
            ->get();
        return $jobByCities;
    }

    public function getJobBySkills($skillName)
    {
        // TODO: Implement getJobBySkills() method.
        $jobBySkills = $this->model
            ->select(DB::raw('COUNT(SeekerJobId) as seekerNumber'), 'jobs.JobId as JobId', 'JobName',
                'PositionName', 'Skill', 'jobs.Status as Status', 'jobs.created_at as CreatedDate',
                'recruiters.CompanyLogo as CompanyLogo', 'recruiters.Address as Address','jobs.Benifit as Benifit',
                'jobs.Salary as Salary','cities.CityName as City','jobs.Description as Description','jobs.EndDateApply as EndDateApply' )
            ->leftJoin('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
            ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
            ->leftJoin('cities','jobs.CityId','=','cities.CityId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->groupBy('JobId','JobName','PositionName', 'Skill','jobs.Status','Address', 'jobs.created_at','CompanyLogo','Salary','Benifit','City','jobs.Description','EndDateApply')
            ->where('jobs.IsDelete','=',1)
            ->where('jobs.Skill', 'like', '%'.$skillName.'%')
            ->get();
        return $jobBySkills;
    }

    public function getJobByPage($request, $recordNumber)
    {
        // TODO: Implement getJobByPage() method.
        $jobs = $this->model->with('position:PositionId,PositionName');
        if($request){
            if($request->jobname) $jobs->where('JobName', 'like', '%'.$request->jobname.'%');
            if($request->recruiter) $jobs->where('RecruiterId',$request->recruiter);
        }
        $jobs = $jobs->orderByDesc('JobId')->paginate($recordNumber);
        return $jobs;
    }

    public function getJobRecruiterByPage($request, $recruiterId, $recordNumber)
    {
        // TODO: Implement getJobRecruiterByPage() method.
        $query = $this->model
            ->select(DB::raw('count(SeekerJobId) as seekerNumber, jobs.JobId as JobId, JobName, PositionName, Skill, jobs.Status as Status, Address, jobs.created_at as CreatedDate','jobs.StartDateApply as StartDateApply','jobs.EndDateApply as EndDateApply'))
            ->leftJoin('seeker_jobs','jobs.JobId','=','seeker_jobs.JobId')
            ->leftJoin('positions','jobs.PositionId','=','positions.PositionId')
            ->where('RecruiterId',$recruiterId)
            ->where('jobs.IsDelete',1)
            ->groupBy('jobs.JobId','JobName','PositionName', 'Skill','jobs.Status','Address', 'jobs.created_at','StartDateApply','EndDateApply')
            ->orderBy('seekerNumber','desc');
        if($request){
            if($request->jobname) $query->where('JobName', 'like', '%'.$request->jobname.'%');
            if($request->position) $query->where('jobs.PositionId',$request->position);
        }
        $query = $query->paginate($recordNumber);
        return $query;

    }

    public function changeStatus($jobId)
    {
        // TODO: Implement changeStatus() method.
        $job = $this->getJobById($jobId);
        $job->Status = $job->Status = 1;
        $job->save();
    }

    public function createJob($inputJob)
    {
        // TODO: Implement createJob() method.
        $code = 1;
        $job = new $this->model;

        try{
            $job->JobName = $inputJob->JobName;
            $job->Skill = $inputJob->Skill;
            $job->PositionId = $inputJob->PositionId;
            $job->Require = $inputJob->Require;
            $job->Description = $inputJob->Description;
            $job->Benifit = $inputJob->Benefit;
            $job->Salary = $inputJob->Salary;
            $job->Address = $inputJob->Address;
            $job->CityId = $inputJob->City;
            $job->StartDateApply = $inputJob->StartDateApply;
            $job->EndDateApply = $inputJob->EndDateApply;
            $job->AdminId = 1;
            $job->RecruiterId = Auth::guard('recruiters')->user()->id;
            $job->save();
            return $code;
        }catch(\Exception $exception)
        {
            $code=0;
            return $code;
        }

    }

    public function updateJob($inputJob, $jobId)
    {
        // TODO: Implement updateJob() method.
        $code = 1;
        $job = $this->model::find($jobId);
        try{
        $job->JobName = $inputJob->JobName;
        $job->Skill = $inputJob->Skill;
        $job->PositionId = $inputJob->PositionId;
        $job->Require = $inputJob->Require;
        $job->Description = $inputJob->Description;
        $job->Benifit = $inputJob->Benefit;
        $job->Salary = $inputJob->Salary;
        $job->Address = $inputJob->Address;
        $job->CityId = $inputJob->City;
        $job->StartDateApply = $inputJob->StartDateApply;
        $job->EndDateApply = $inputJob->EndDateApply;
        $job->AdminId = 1;
        $job->RecruiterId = Auth::guard('recruiters')->user()->id;
        $job->save();
            return $code;
        }catch(\Exception $exception)
        {
            $code=0;
            return $code;
        }

    }
}