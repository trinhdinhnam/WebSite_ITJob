<?php

namespace Modules\Admin\Http\Controllers;

use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Recruiter;
use App\Models\Transaction;
class AdminTransactionController extends AdminBaseController
{

    public $transactionRepository;
    public $recruiterRepository;

    public function __construct(ITransactionRepository $transactionRepository, IRecruiterRepository $recruiterRepository,IJobRepository $jobRepository)
    {
        parent::__construct($transactionRepository,$jobRepository);
        $this->recruiterRepository = $recruiterRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function getTransactions(Request $request,$id){
        $this->getDataShared();

        if($request->ajax()){
            $transactions  = $this->transactionRepository->getListTransactionByRecruierId($id);
            $html = view('admin::transaction.index', compact('transactions'))->render();
            return \response()->json($html);
        }
    }

    public function actionTransaction($actiontran,$id)
    {
        $this->getDataShared();

        if($actiontran){
            switch($actiontran)
            {
                case 'status':
                    $changeStatus = $this->transactionRepository->changeStatus($id);
                    if($changeStatus){
                        $this->recruiterRepository->updatePostNumber($changeStatus->RecruiterId,$changeStatus->PostNumber);
                        return redirect()->back()->with(['flash-message'=>'Success ! Duyệt giao dịch thành công !','flash-level'=>'success']);
                    }else{
                        return redirect()->back()->with(['flash-message'=>'Error ! Duyệt giao dịch thất bại !','flash-level'=>'danger']);
                    }
                    break;
            }
        }
        return redirect()->back();

    }

    public function getDetailTransaction($transactionId){
        $this->getDataShared();
        $transactionDetail = $this->transactionRepository->getTransactionById($transactionId);
        $viewData = [
            'transactionDetail' => $transactionDetail,
        ];
        return view('admin::transaction.detail',$viewData);
    }
}