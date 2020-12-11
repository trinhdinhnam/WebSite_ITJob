<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Recruiter;
use App\Models\Transaction;
class AdminTransactionController extends Controller
{
    public function getTransactions(Request $request,$id){
        //     $transactionDetail = Transaction::with('accountPackage:AccountPackageId,AccountPackageName,Price,PostNumber')
        //                                     ->where('RecruiterId',$id)->get();
        //     $viewData = [
        //         'transactionDetail' =>$transactionDetail
        //     ];
        // return view('admin::transaction.index',$viewData);
        if($request->ajax()){
            $transactions  = Transaction::with('accountPackage:AccountPackageId,AccountPackageName,Price,PostNumber')
                                       ->where('RecruiterId',$id)->get();
            $html = view('admin::transaction.index', compact('transactions'))->render();
            return \response()->json($html);
        }
    }
}