<?php


namespace App\Repository\AccountPackage;


use App\Models\AccountPackage;
use App\Repository\BaseRepository;

class AccountPackageRepository extends BaseRepository implements IAccountPackageRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return AccountPackage::class;
    }

    public function getListAccountPackages()
    {
        // TODO: Implement getListAccountPackages() method.

        return $this->model->all();
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getAccountPackageById($accountId)
    {
        // TODO: Implement getAccountPackageById() method.
        return $this->model->where('AccountPackageId',$accountId)->first();
    }
}