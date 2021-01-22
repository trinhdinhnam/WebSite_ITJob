<?php


namespace App\Repository\SeekerJob;


use App\Models\SeekerJob;
use App\Repository\BaseRepository;
use App\Repository\Seeker\ISeekerRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeekerJobRepository extends BaseRepository implements ISeekerJobRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return SeekerJob::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getSeekerByJob($jobId)
    {
        // TODO: Implement getSeekerByJob() method.
        $seekerByJob = $this->model
            ->with('seeker:id,SeekerName,Education,Email,Phone,Gender,Avatar')
            ->where('JobId',$jobId)
            ->where('IsDelete',1)
            ->get();
        return $seekerByJob;

    }

    public function getSeekerDetail($seekerJobId)
    {
        // TODO: Implement getSeekerDetail() method.
        $seekerDetail = $this->model->with('seeker:id,SeekerName,Education,Email,Phone,Gender,Avatar,Address,DateOfBirth')
            ->where('SeekerJobId',$seekerJobId)
            ->first();
        return $seekerDetail;
    }


    public function deleteSeekerJobById($id)
    {
        // TODO: Implement deleteSeekerJobById() method.
        $seekerJobById = $this->getSeekerJobById($id);
        $seekerJobById->IsDelete = $seekerJobById->IsDelete ? 0 : 1;
        $seekerJobById->save();
    }

    public function getSeekerJobById($id)
    {
        // TODO: Implement getSeekerJobById() method.

        return $this->model->find($id);
    }

    public function changeStatusById($id)
    {
        // TODO: Implement changeStatusById() method.
        $seekerJobById = $this->getSeekerJobById($id);
        $seekerJobById->Status = $seekerJobById->Status ? 0 : 1;
        $seekerJobById->MessageStatus = 1;
        $seekerJobById->save();
    }

    public function addCVApply($seekerJobInput,$jobId)
    {
        // TODO: Implement addCVApply() method.
        try {
            $seekerJob = new $this->model;
            $seekerJob->SeekerId = Auth::guard('seekers')->user()->id;
            $seekerJob->JobId = $jobId;
            $seekerJob->Introduce = $seekerJobInput->Introduce;
            $seekerJob->SeekerName = $seekerJobInput->SeekerName;
            $seekerJob->SeekerEmail = $seekerJobInput->SeekerEmail;
            $seekerJob->SeekerPhone = $seekerJobInput->SeekerPhone;
            $seekerJob->SeekerAddress = $seekerJobInput->SeekerAddress;
            if($seekerJobInput->hasFile('SeekerAvatar'))
            {
                $fileAvatar = $seekerJobInput->file('SeekerAvatar');
                $file = upload_image($fileAvatar,$fileAvatar->getClientOriginalName());
                if(isset($file['name'])){
                    $seekerJob->SeekerAvatar = $file['name'];
                }
            }
            else{
                $seekerJob->SeekerAvatar = Auth::guard('seekers')->user()->Avatar;
            }
            if ($seekerJobInput->hasFile('SeekerCVLink')) {
                $fileCV = $seekerJobInput->file('SeekerCVLink');
                $fileCVLink = upload_cv($fileCV, $fileCV->getClientOriginalName());
                if (isset($fileCVLink['name'])) {
                    $seekerJob->CVLink = $fileCVLink['name'];
                }
            }
            $seekerJob->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $seekerJob->save();
            return $seekerJob;
        }catch (\Exception $e){
            return false;
        }

    }

    public function getMessageNumber($seekerId)
    {
        // TODO: Implement getMessageNumber() method.
        $message = $this->model
                ->where('SeekerId', $seekerId)
                ->where('MessageStatus',1)
                ->get();
        return count($message);

    }

    public function getMessageInfo($seekerId)
    {
        // TODO: Implement getMessageInfo() method.
        $messageInfo = $this->model->select(DB::raw('jobs.JobName as JobName, seeker_jobs.updated_at as MessageDate, seeker_jobs.JobId as JobId, recruiters.CompanyLogo as CompanyLogo, recruiters.CompanyName as CompanyName, seeker_jobs.MessageStatus as MessageStatus'))
            ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->where('SeekerId', $seekerId)
            ->where('seeker_jobs.Status',1)
            ->paginate(10);
        return $messageInfo;
    }

    public function changeMessageStatusById($jobId,$seekerId)
    {
        // TODO: Implement changeMessageStatusById() method.
        try{
            $seekerJob = $this->model
                              ->where('JobId',$jobId)
                              ->where('SeekerId',$seekerId)
                              ->first();
            $seekerJob->MessageStatus = 0;
            $seekerJob->save();
            return true;
        }catch(\Exception $exception)
        {
            return false;
        }
    }

    public function getSeekerByRecruiter($recruiterId,$recordNumber)
    {
        // TODO: Implement getSeekerByRecruiter() method.

        $seeker = $this->model->select('seeker_jobs.SeekerId as SeekerId','seekers.SeekerName as SeekerName','seekers.Email as Email','seekers.Phone as Phone','jobs.JobName as JobName','jobs.JobId as JobId','seeker_jobs.created_at as ApplyDate','seeker_jobs.Introduce as Introduce','seeker_jobs.Status as Status','seeker_jobs.MessageApplyStatus as MessageApplyStatus','seekers.Avatar as Avatar')
                              ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
                              ->leftJoin('seekers','seeker_jobs.SeekerId','=','seekers.id')
                              ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
                              ->where('recruiters.id','=',$recruiterId)
                              ->orderBy('jobs.created_at','desc')
                              ->orderBy('seeker_jobs.Status','asc')
                              ->orderBy('seeker_jobs.created_at','desc');

        if($recordNumber){
           $seeker = $seeker->paginate($recordNumber);
        }
        else{
            $seeker = $seeker->get();
        }
        return $seeker;
    }

    public function getRevenueProfile($recruiterId)
    {
        // TODO: Implement getRevenueProfile() method.
        $revenueProfile = $this->model
            ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->where('recruiters.id','=',$recruiterId)
            ->whereYear('seeker_jobs.created_at',date('Y')-1)
            ->select(DB::raw('count(seeker_jobs.SeekerJobId) as profileNumber'), DB::raw('month(seeker_jobs.created_at) as month'))
            ->groupBy('month')
            ->get()->toArray();
        return $revenueProfile;
    }

    public function getRevenueProfileByJob($recruiterId)
    {
        // TODO: Implement getRevenueProfileByJob() method.
        $revenueProfileByJob = $this->model
            ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->where('recruiters.id','=',$recruiterId)
            ->whereYear('seeker_jobs.created_at',date('Y'))
            ->select(DB::raw('count(seeker_jobs.SeekerJobId) as profileNumber'), 'jobs.JobId as JobId','jobs.JobName as JobName')
            ->groupBy('JobId','JobName')
            ->get()->toArray();
        return $revenueProfileByJob;
    }

    public function changeMessageApplyStatusById($jobId, $seekerId)
    {
        // TODO: Implement changeMessageApplyStatusById() method.
        try{
            $seekerJob = $this->model
                ->where('JobId',$jobId)
                ->where('SeekerId',$seekerId)
                ->first();
            $seekerJob->MessageApplyStatus = 1;
            $seekerJob->save();
            return true;
        }catch(\Exception $exception)
        {
            return false;
        }
    }

    public function getListSeekerByRecruiter($recruiterId,$request)
    {
        // TODO: Implement getListSeekerByRecruiter() method.
        $seekerByJob = $this->model
            ->with('seeker:id,SeekerName,Education,Email,Phone,Gender,Avatar')
            ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
            ->with('job:JobId,JobName,RecruiterId');
             if($request->seekername) $seekerByJob->where('SeekerName', 'like', '%'.$request->seekername.'%');
            $seekerByJob = $seekerByJob->where('jobs.RecruiterId',$recruiterId)
            ->where('jobs.IsDelete',1)
            ->paginate(5);
        return $seekerByJob;
    }
}