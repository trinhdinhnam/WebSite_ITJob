<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RecruiterTransactionController extends Controller
{

    public $transactionRepository;
    public function __construct(ITransactionRepository $transactionRepository)
    {
         $this->transactionRepository = $transactionRepository;
    }

    public function getBill(Request $request){
        if($request->ajax()) {
            $html = view('recruiter::payment.bill')->render();
            return \response()->json($html);
        }
    }

    public function getTransactions(){

        $recruiterId = Auth::guard('recruiters')->user()->id;
        $transactions  = $this->transactionRepository->getListTransactionByRecruierId($recruiterId);
        $transactionNew = $this->transactionRepository->getTransactionNew($recruiterId);
        $viewData = [
            'transactions' => $transactions,
            'transactionNew' => $transactionNew
        ];
        return view('recruiter::transaction.transaction-history',$viewData);
    }


}
