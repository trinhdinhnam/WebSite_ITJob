<?php


namespace App\Repository\Transaction;


use App\Models\Transaction;
use App\Repository\BaseRepository;

class TransactionRepository extends BaseRepository implements ITransactionRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Transaction::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getListTransactionByRecruierId($id)
    {
        // TODO: Implement getListTransactionByRecruierId() method.
        return $this->model->with('accountPackage:AccountPackageId,AccountPackageName,Price,PostNumber')
            ->where('RecruiterId',$id)->get();

    }

    public function getTransactionById($id)
    {
        // TODO: Implement getTransactionById() method.
        return $this->model->find($id);
    }

    public function changeStatus($id)
    {
        // TODO: Implement changeStatus() method.
        $tran = $this->getTransactionById($id);
        $tran->Status = $tran->Status ? 0 : 1;
        $tran->save();
        return true;
    }
}