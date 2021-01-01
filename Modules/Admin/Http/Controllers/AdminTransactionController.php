<?php

namespace Modules\Admin\Http\Controllers;

use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Recruiter;
use App\Models\Transaction;
class AdminTransactionController extends Controller
{

    public $transactionRepository;

    public function __construct(ITransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getTransactions(Request $request,$id){

        if($request->ajax()){
            $transactions  = $this->transactionRepository->getListTransactionByRecruierId($id);
            $html = view('admin::transaction.index', compact('transactions'))->render();
            return \response()->json($html);
        }
    }

    public function actionTransaction($actiontran,$id)
    {
        if($actiontran){
            switch($actiontran)
            {
                case 'status':
                    try{
                        $this->transactionRepository->changeStatus($id);
                        return redirect()->back()->with(['flash-message'=>'Success ! Duyệt giao dịch thành công !','flash-level'=>'success']);
                    }catch (\Exception $e){
                        return redirect()->back()->with(['flash-message'=>'Error ! Duyệt giao dịch thất bại !','flash-level'=>'danger']);

                    }

                    break;
            }
        }
        return redirect()->back();

    }
}