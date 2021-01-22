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
            ->where('RecruiterId',$id)
            ->orderBy('PayDate','desc')
            ->get();

    }

    public function getTransactionById($id)
    {
        // TODO: Implement getTransactionById() method.
        return $this->model
            ->with('recruiter:id,RecruiterName,CompanyName')
            ->with('accountPackage:AccountPackageId,AccountPackageName')
            ->where('TransactionId','=',$id)
            ->first();
    }

    public function changeStatus($id)
    {
        // TODO: Implement changeStatus() method.
        try{
            $tran = $this->getTransactionById($id);
            $tran->Status = 1;
            $tran->ExipryDate = Carbon::now()->addMonth();
            $tran->ApprovalDate = Carbon::now();
            $tran->save();
            return $tran;

        }catch (\Exception $e){
            return false;
        }

    }

    public function getTransactionNew($id)
    {
        // TODO: Implement getExpiryDateCurrent() method.
        return $this->model
            ->select('ExipryDate','Status')
            ->where('RecruiterId',$id)
            ->orderBy('PayDate','desc')
            ->first();
    }

    public function getRevenueTransactionMonth()
    {
        // TODO: Implement getRevenueTransactionMoth() method.
        $revenueTransactionMonth = $this->model
            ->leftJoin('account_packages','transactions.AccountPackageId','=','account_packages.AccountPackageId')
            ->whereYear('transactions.created_at',date('Y')-1)
            ->select(DB::raw('sum(account_packages.Price) as totalMoney'),DB::raw('sum(transactions.RecruiterId) as totalRecruiter'), DB::raw('month(transactions.created_at) as month'))
            ->groupBy('month')
            ->get()->toArray();
        return $revenueTransactionMonth;
    }

    public function getRevenueAccountNumber($type)
    {
        // TODO: Implement getRevenueAccountNumber() method.
        $revenueAccountNumber = $this->model->leftJoin('account_packages','transactions.AccountPackageId','=','account_packages.AccountPackageId')
                                            ->select('account_packages.AccountPackageId as accountId','account_packages.AccountPackageName as accountName','account_packages.Price as Price', DB::raw('count(transactions.TransactionId) as accountNumber'))
                                            ->whereYear('transactions.created_at',date('Y')-1)
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
        try{
            $transaction = new $this->model;
            $transaction->RecruiterId = $recruiterId;
            $transaction->AccountPackageId = $accountId;
            $transaction->PayDate = Carbon::now();
            $transaction->Total = $inputTransaction->totalMoney;
            $transaction->PostNumber = $inputTransaction->postNumber;
            $transaction->Note = $inputTransaction->note;
            $transaction->Phone = $inputTransaction->phone;
            $transaction->Email = $inputTransaction->email;
            $transaction->Language = $inputTransaction->language;
            $transaction->BankName = $inputTransaction->bank_code;
            $transaction->created_at = Carbon::now();
            $transaction->save();
            return $transaction->TransactionId;
        }catch (\Exception $e){
            return false;
        }

    }

    public function getTransactionByPage($recordNumber)
    {
        // TODO: Implement getTransactionByPage() method.
        return $this->model
            ->with('recruiter:id,RecruiterName,CompanyName,Position')
            ->with('accountPackage:AccountPackageId,AccountPackageName')
            ->orderBy('PayDate','desc')
            ->orderBy('transactions.Status','asc')
            ->paginate($recordNumber);
    }

    public function getTransactionRecruiterByPage($recruiterId,$recordNumber)
    {
        // TODO: Implement getTransactionRecruiterByPage() method.
        return $this->model->with('accountPackage:AccountPackageId,AccountPackageName,Price,PostNumber')
            ->where('RecruiterId',$recruiterId)
            ->orderBy('PayDate','desc')
            ->paginate($recordNumber);
    }

    public function getMessageTransaction()
    {
        // TODO: Implement getMessageTransaction() method.
        return $this->model->with('recruiter:id,RecruiterName,CompanyName,Position,Avatar')
            ->orderBy('PayDate','desc')
            ->paginate(6);
    }

    public function changeMessageStatus($tranId)
    {
        // TODO: Implement changeMessageStatus() method.
        try{
            $transaction = $this->model
                ->where('TransactionId',$tranId)
                ->first();
            $transaction->MessageStatus = 1;
            $transaction->save();
            return true;
        }catch(\Exception $exception)
        {
            return false;
        }
    }
}