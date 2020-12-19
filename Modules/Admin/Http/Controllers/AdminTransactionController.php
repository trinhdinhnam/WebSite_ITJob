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
                    $this->transactionRepository->changeStatus($id);
                    break;
            }
        }
        return redirect()->back();

    }
}