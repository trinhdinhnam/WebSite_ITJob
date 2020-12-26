<?php


namespace App\Repository\Seeker;


use App\Models\Seeker;
use App\Models\SeekerJob;
use App\Repository\BaseRepository;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;

class SeekerRepository extends BaseRepository implements ISeekerRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Seeker::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getSeekerDetail()
    {
        // TODO: Implement getSeekerDetail() method.
    }

    public function getSeekerByJob($jobId)
    {
        // TODO: Implement getSeekerByJob() method.
        $seekerByJob = $this->model->with('seekerJob:JobId,SeekerId,IsDelete,Status')
            ->where('JobId',$jobId)
            ->where('seeker_jobs.IsDelete',1)
            ->get();
        return $seekerByJob;
    }

    public function addSeeker($seekerInput)
    {
        // TODO: Implement addSeeker() method.
        $seeker = new $this->model;
        $seeker->SeekerName = $seekerInput->SeekerName;
        $seeker->Education = $seekerInput->Education;
        $seeker->Gender = $seekerInput->Gender;
        $seeker->email = $seekerInput->Email;
        $seeker->Phone = $seekerInput->Phone;
        $seeker->DateOfBirth = $seekerInput->DateOfBirth;
        $seeker->Address = $seekerInput->Address;
        $seeker->Password = bcrypt($seekerInput->Password);
        if($seekerInput->hasFile('Avatar'))
        {
            $fileAvatar = $seekerInput->file('Avatar');
            $file = upload_image($fileAvatar,$fileAvatar->getClientOriginalName());
            if(isset($file['name'])){
                $seeker->Avatar = $file['name'];
            }
        }
        $seeker->save();
        return true;
    }

    public function changeInfoSeeker($seekerInput,$seekerId)
    {
        // TODO: Implement changeInfoSeeker() method.

        $seekerEdit = $this->model->find($seekerId);
        $seekerEdit->SeekerName = $seekerInput->SeekerName;
        $seekerEdit->Education = $seekerInput->Education;
        $seekerEdit->email = $seekerInput->Email;
        $seekerEdit->Address = $seekerInput->Address;
        $seekerEdit->Phone = $seekerInput->Phone;
        $seekerEdit->DateOfBirth = $seekerInput->DateOfBirth;

        if(isset($seekerInput->Avatar)){
            if($seekerInput->hasFile('Avatar'))
            {
                $fileAvatar = $seekerInput->file('Avatar');
                $file = upload_image($fileAvatar,$fileAvatar->getClientOriginalName());
                if(isset($file['name'])){
                    $seekerEdit->Avatar = $file['name'];
                }
            }
        }
        $seekerEdit->save();

        return true;
    }

    public function changPasswordSeeker($seekerInput, $seekerId)
    {
        // TODO: Implement changPasswordSeeker() method.
        $seekerChangePass = $this->model->find($seekerId);
        $seekerChangePass->password = bcrypt($seekerInput->pass_new);
        $seekerChangePass->save();
        return $seekerChangePass;
    }


}