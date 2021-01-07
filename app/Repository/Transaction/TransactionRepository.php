<?php


namespace App\Repository\Transaction;


use App\Models\Transaction;
use App\Repository\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function getTransactionNew($id)
    {
        // TODO: Implement getExpiryDateCurrent() method.
        return $this->model
            ->select('ExipryDate')
            ->where('RecruiterId',$id)
            ->orderBy('ExipryDate','desc')
            ->first();
    }

    public function getRevenueTransactionMoth()
    {
        // TODO: Implement getRevenueTransactionMoth() method.
        $revenueTransactionMonth = $this->model
            ->leftJoin('account_packages','transactions.AccountPackageId','=','account_packages.AccountPackageId')
            ->whereYear('transactions.created_at',date('Y')-1)
            ->select(DB::raw('sum(account_packages.Price) as totalMoney'), DB::raw('month(transactions.created_at) as month'))
            ->groupBy('month')
            ->get()->toArray();
        return $revenueTransactionMonth;
    }

    public function getRevenueAccountNumber($type)
    {
        // TODO: Implement getRevenueAccountNumber() method.
        $revenueAccountNumber = $this->model->leftJoin('account_packages','transactions.AccountPackageId','=','account_packages.AccountPackageId')
                                            ->select('account_packages.AccountPackageId as accountId','account_packages.AccountPackageName as accountName','account_packages.Price as Price', DB::raw('count(transactions.TransactionId) as accountNumber'))
                                            ->groupBy('accountId','accountName','Price')
                                            ->orderBy('accountNumber','desc')
                                            ->get();
        if($type=='array'){
            $revenueAccountNumber = $revenueAccountNumber->toArray();
        }
        return $revenueAccountNumber;

    }

    public function getAllTransactions()
    {
        // TODO: Implement getAllTransactions() method.
        return $this->model->with('recruiter:id,RecruiterName,CompanyName,Position')->get();
    }

    public function deleteTransactionById($id)
    {
        // TODO: Implement deleteTransactionById() method.
        $tranDelete = $this->getTransactionById($id);
        $tranDelete->delete();
        return true;
    }

    public function addTransaction($inputTransaction,$recruiterId,$accountId)
    {
        // TODO: Implement addTransaction() method.
        $transaction = new $this->model;
        $transaction->RecruiterId = $recruiterId;
        $transaction->AccountPackageId = $accountId;
        $transaction->PayDate = Carbon::now();
        $transaction->ExipryDate = Carbon::now()->addMonth();
        $transaction->Total = $inputTransaction->totalMoney;
        $transaction->Note = $inputTransaction->note;
        $transaction->Phone = $inputTransaction->phone;
        $transaction->Email = $inputTransaction->email;
        $transaction->Language = $inputTransaction->language;
        $transaction->created_at = Carbon::now();
        $transaction->save();
        return $transaction->TransactionId;
    }

    public function getTransactionByPage($recordNumber)
    {
        // TODO: Implement getTransactionByPage() method.
        return $this->model
            ->with('recruiter:id,RecruiterName,CompanyName,Position')
            ->with('accountPackage:AccountPackageId,AccountPackageName')
            ->orderBy('PayDate','desc')
            ->paginate($recordNumber);

    }

    public function getTransactionRecruiterByPage($recruiterId,$recordNumber)
    {
        // TODO: Implement getTransactionRecruiterByPage() method.
        return $this->model->with('accountPackage:AccountPackageId,AccountPackageName,Price,PostNumber')
            ->where('RecruiterId',$recruiterId)->paginate($recordNumber);
    }
}