<?php


namespace App\Repository\CompanyImage;


use App\Models\CompanyImage;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

class CompanyImageRepository extends BaseRepository implements ICompanyImageRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return CompanyImage::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function addCompanyImage($input, $recruiterId)
    {
        // TODO: Implement addCompanyImage() method.
        try{
            if ($input->hasFile('Image')){
                $arrayImage = $input->file('Image');
                foreach ($arrayImage as $file){
                    $fileImage = upload_image($file,$file->getClientOriginalName());
                    $company_img = new $this->model;
                    if(isset($fileImage['name'])){
                        $company_img->Image = $fileImage['name'];
                        $company_img->RecruiterId = $recruiterId;
                        $company_img->save();
                    }
                }
            }
            return true;
        }catch (\Exception $e){
            return false;
        }

    }

    public function getCompanyImageById($recruiterId,$limit)
    {
        // TODO: Implement getCompanyImageById() method.
        $companyImageById =  $this->model
            ->where('RecruiterId',$recruiterId);

            if($limit>0){
                $companyImageById = $companyImageById->limit($limit)->first();
            }else{
                $companyImageById = $companyImageById->get();
            }
        return $companyImageById;
    }

    public function changeImageCompany($inputImage, $recruiterId)
    {
        // TODO: Implement changeImageCompany() method.
        try{
            if ($inputImage->hasFile('Image')){
                $arrayImage = $inputImage->file('Image');
                $company_img = $this->model->where('RecruiterId',$recruiterId);
                foreach ($arrayImage as $file){
                    $fileImage = upload_image($file,$file->getClientOriginalName());
                    if(isset($fileImage['name'])){
                        $company_img->Image = $fileImage['name'];
                        $company_img->save();
                    }
                }
            }
            return true;
        }catch (\Exception $e){
            return false;
        }

    }
}