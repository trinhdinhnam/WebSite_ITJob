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
        $seekerByJob = $this->model->with('seeker:id,SeekerName,Education,Email,Phone,Gender,Avatar')
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
        $seekerJobById->save();
    }

    public function addCVApply($seekerJobInput,$jobId)
    {
        // TODO: Implement addCVApply() method.
        $seekerJob = new $this->model;
        $seekerJob->SeekerId = Auth::guard('seekers')->user()->id;
        $seekerJob->JobId = $jobId;
        $seekerJob->Introduce = $seekerJobInput->Introduce;
        if($seekerJobInput->hasFile('CVLink'))
        {
            $fileCV = $seekerJobInput->file('CVLink');
            $fileCVLink = upload_cv($fileCV,$fileCV->getClientOriginalName());
            if(isset($fileCVLink['name'])){
                $seekerJob->CVLink = $fileCVLink['name'];
            }
        }
        $seekerJob->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $seekerJob->save();
        return true;
    }

    public function getMessageNumber()
    {
        // TODO: Implement getMessageNumber() method.

        $message = $this->model;

            $message = $message
                ->where('SeekerId', 1)
                ->where('MessageStatus',1)
                ->get();
        return count($message);

    }

    public function getMessageInfo()
    {
        // TODO: Implement getMessageInfo() method.
        $messageInfo = $this->model->select(DB::raw('jobs.JobName as JobName, seeker_jobs.updated_at as MessageDate, seeker_jobs.JobId as JobId, recruiters.CompanyLogo as CompanyLogo, recruiters.CompanyName as CompanyName, seeker_jobs.MessageStatus as MessageStatus'))
            ->leftJoin('jobs','seeker_jobs.JobId','=','jobs.JobId')
            ->leftJoin('recruiters','jobs.RecruiterId','=','recruiters.id')
            ->where('SeekerId', 1)
            ->where('seeker_jobs.Status',1)
            ->paginate(10);
        return $messageInfo;
    }

    public function changeMessageStatusById($jobId,$seekerId)
    {
        // TODO: Implement changeMessageStatusById() method.
        $seekerJob = $this->model->where('JobId',$jobId)
            ->where('SeekerId',$seekerId)
            ->first();
        $seekerJob->MessageStatus = 0;
        $seekerJob->save();
    }
}