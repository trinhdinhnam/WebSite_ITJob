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
            ->select(DB::raw('count(JobId) as jobNumber, recruiters.id as RecruiterId, CompanyLogo, CompanyName, cities.CityName as City'))
            ->leftJoin('jobs','recruiters.id','=','jobs.RecruiterId')
            ->leftJoin('cities','recruiters.CityId','=','cities.CityId')
            ->groupBy('recruiters.id','CompanyLogo','CompanyName','City')
            ->get();

        return $recruiters;
    }

    public function addRecruiter($input)
    {
        // TODO: Implement addRecruiter() method.

        $recruiter = new $this->model;
        $recruiter->RecruiterName = $input->RecruiterName;
        $recruiter->Position = $input->Position;
        $recruiter->Email = $input->Email;
        $recruiter->Phone = $input->Phone;
        $recruiter->Password = bcrypt($input->Password);
        $recruiter->CompanyName = $input->CompanyName;
        $recruiter->Address = $input->Address;
        $recruiter->CityId = $input->City;
        $recruiter->Country = $input->Country;
        $recruiter->Introduction = $input->Introduction;
        $recruiter->WorkDay = $input->WorkDay;
        $recruiter->TimeWork = $input->TimeWork;
        $recruiter->CompanySize = $input->CompanySize;
        $recruiter->TypeBusiness = $input->TypeBusiness;

        if($input->hasFile('CompanyLogo'))
        {
            $fileCompanyLogo = $input->file('CompanyLogo');
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

    public function getAllRecruiter($request)
    {
        // TODO: Implement getAllRecruiter() method.
        $recruiter = $this->model->where('IsDelete',1);
        if($request)
        {
            if($request->RecruiterName) $recruiter->where('RecruiterName', 'like', '%'.$request->RecruiterName.'%');
            if($request->Company) $recruiter->where('id',$request->Company);
        }
        $recruiter = $recruiter->get();
        return $recruiter;

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

    public function updateReview($recruiterId,$scoreReview)
    {
        // TODO: Implement updateReview() method.
        $recruiter = $this->model->find($recruiterId);
        $recruiter->ScoreReview += $scoreReview;
        $recruiter->ReviewNumber += 1;
        $recruiter->save();
        return;
    }

    public function changInfoRecruiter($inputRecruiter, $recruiterId)
    {
        // TODO: Implement changInfoRecruiter() method.
        $recruiter = $this->model->find($recruiterId);
        $recruiter->RecruiterName = $inputRecruiter->RecruiterName;
        $recruiter->Position = $inputRecruiter->Position;
        $recruiter->Email = $inputRecruiter->Email;
        $recruiter->Phone = $inputRecruiter->Phone;
        $recruiter->CompanyName = $inputRecruiter->CompanyName;
        $recruiter->Address = $inputRecruiter->Address;
        $recruiter->CityId = $inputRecruiter->City;
        $recruiter->Country = $inputRecruiter->Country;
        $recruiter->Introduction = $inputRecruiter->Introduction;
        $recruiter->WorkDay = $inputRecruiter->WorkDay;
        $recruiter->TimeWork = $inputRecruiter->TimeWork;
        $recruiter->CompanySize = $inputRecruiter->CompanySize;
        $recruiter->TypeBusiness = $inputRecruiter->TypeBusiness;

        if($inputRecruiter->hasFile('CompanyLogo'))
        {
            $fileCompanyLogo = $inputRecruiter->file('CompanyLogo');
            $fileLogo = upload_image($fileCompanyLogo,$fileCompanyLogo->getClientOriginalName());
            if(isset($fileLogo['name'])){
                $recruiter->CompanyLogo = $fileLogo['name'];
            }
        }
        $recruiter->save();
        return true;
    }

    public function changePassRecruiter($input, $recruiterId)
    {
        // TODO: Implement changePassRecruiter() method.
        $recruiter = $this->model->find($recruiterId);
        $recruiter->password = bcrypt($input['pass_new']);
        $recruiter->save();
    }
}