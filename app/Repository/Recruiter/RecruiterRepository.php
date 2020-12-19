<?php


namespace App\Repository\Recruiter;


use App\Models\Recruiter;
use App\Repository\BaseRepository;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB;

class RecruiterRepository extends BaseRepository implements IRecruiterRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.

        return Recruiter::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getListRecruiters()
    {
        // TODO: Implement getListRecruiters() method.
        $recruiters = $this->model
            ->select(DB::raw('count(JobId) as jobNumber, recruiters.id as RecruiterId, CompanyLogo, CompanyName, recruiters.City as City'))
            ->leftJoin('jobs','recruiters.id','=','jobs.RecruiterId')
            ->groupBy('recruiters.id','CompanyLogo','CompanyName','City')
            ->get();

        return $recruiters;
    }

    public function addRecruiter($input)
    {
        // TODO: Implement addRecruiter() method.

        $recruiter = new $this->model;
        $recruiter->RecruiterName = $input['RecruiterName'];
        $recruiter->Position = $input['Position'];
        $recruiter->Email = $input['Email'];
        $recruiter->Phone = $input['Phone'];
        $recruiter->Password = bcrypt($input['Password']);
        $recruiter->CompanyName = $input['CompanyName'];
        $recruiter->Address = $input['Address'];
        $recruiter->CityId = $input['City'];
        $recruiter->Country = $input['Country'];
        $recruiter->Introduction = $input['Introduction'];
        $recruiter->WorkDay = $input['WorkDay'];
        $recruiter->TimeWork = $input['TimeWork'];
        $recruiter->CompanySize = $input['CompanySize'];
        $recruiter->TypeBusiness = $input['TypeBusiness'];

        if($input->hasFile('CompanyLogo'))
        {
            $fileCompanyLogo = $input['CompanyLogo']->file();
            $fileLogo = upload_image($fileCompanyLogo,$fileCompanyLogo->getClientOriginalName());
            if(isset($fileLogo['name'])){
                $recruiter->CompanyLogo = $fileLogo['name'];
            }
        }
        $recruiter->save();
        return $recruiter->id;
    }

    public function getRecruiterById($id)
    {
        // TODO: Implement getRecruiterById() method.
         return $this->model->where('id',$id)->first();
    }

    public function deleteRecruiter($id)
    {
        // TODO: Implement deleteRecruiter() method.
        $recruiter = $this->getRecruiterById($id);
        $recruiter->IsDelete = $recruiter->IsDelete ? 0 : 1;
        $recruiter->save();
        return true;

    }

    public function changeActive($id)
    {
        // TODO: Implement changeActive() method.
        $recruiter = $this->getRecruiterById($id);
        $recruiter->Active = $recruiter->Active ? 0 : 1;
        $recruiter->save();
        return true;
    }

    public function getAllRecruiter()
    {
        // TODO: Implement getAllRecruiter() method.
        return $this->model->where('IsDelete',1)->get();

    }

    public function getRecruiterHot()
    {
        // TODO: Implement getRecruierHot() method.
        $recruiterHot = $this->model
            ->join('transactions','recruiters.id','=','transactions.RecruiterId')
            ->join('account_packages','transactions.AccountPackageId','=','account_packages.AccountPackageId')
            ->orderBy('transactions.PayDate','desc')
            ->orderBy('account_packages.Price','desc')
            ->first();
        return $recruiterHot;
    }
}