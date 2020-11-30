<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Recruiter;
use App\Models\Pay;

class AdminRecruiterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $recruiters = Recruiter::where('IsDelete',1)
                                 ->get();
        $viewData = [
             'recruiters' => $recruiters
        ];
        return view('admin::recruiter.index', $viewData);
    }

    public function getDetailRecruiter($id){
        $recruiterDetail = Recruiter::where('id',$id)->first();
        $viewData = [
            'recruiterDetail' =>$recruiterDetail
        ];
        return view('admin::recruiter.recruiter_detail',$viewData);
    }
    public function getDetailTransaction($id){
        $transactionDetail = Pay::with('accountPackage:AccountPackageId,AccountPackageName,Price')
                                ->where('RecruiterId',$id)->get();
        $viewData = [
            'transactionDetail' =>$transactionDetail
        ];
        return view('admin::recruiter.transaction_detail',$viewData);
    }
    public function action($action,$id)
    {
        $recruiter = Recruiter::find($id);

        if($action){
            switch($action)
            {
                case 'active':
                    $recruiter->Active = $recruiter->Active ? 0 : 1;
                    $recruiter->save();
                break;
                case 'delete':
                    $recruiter->is_delete = $recruiter->is_delete ? 0 : 1;
                    $recruiter->save();                    
                break;
            }
        }
        return redirect()->back();
    }

    public function actionTransaction($actiontran,$id)
    {
        $tran = Pay::find($id);
        if($actiontran){
            switch($actiontran)
            {
                case 'status':
                    $tran->Status = $tran->Status ? 0 : 1;
                    $tran->save();
                break;
            }
        }
        return redirect()->back();

    }
}