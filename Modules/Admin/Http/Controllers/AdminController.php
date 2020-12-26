<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Account;
use App\Helpers\Date;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public $transactionRepository;
    public $recruiterRepository;
    public $reviewRepository;
    public $jobRepository;
    public function __construct(ITransactionRepository $transactionRepository,IRecruiterRepository $recruiterRepository,IReviewRepository $reviewRepository,IJobRepository $jobRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->reviewRepository = $reviewRepository;
        $this->jobRepository = $jobRepository;

    }

    public function index()
    {
        $listMonth = Date::getListMonthInYear();
        $revenueTransaction = $this->transactionRepository->getRevenueTransactionMoth();

        $arrRevenueTransaction = [];
        foreach ($listMonth as $month){
            $total = 0;
            foreach ($revenueTransaction as $key => $revenue){
                if($revenue['month'] == $month){
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransaction[] = $total;
        }


        //Thống kê sử dụng gói dịch vụ

        $listAccount = Account::getListAccontId();
        $revenueAccountNumber = $this->transactionRepository->getRevenueAccountNumber();
        $arrRevenueAccountNumber = [];
        foreach ($listAccount as $key1 => $account){
            $count = [];
            foreach ($revenueAccountNumber as $key2 => $revenue){
                if($revenue['accountId'] == $account['AccountPackageId']){
                    $count[0] = $revenue['accountName'];
                    $count[1] = $revenue['accountNumber'];
                    $count[2] = false;
                    $count[3] = '';
                    break;
                }
            }
            $arrRevenueAccountNumber[] = $count;
        }

        //Tổng số giao dịch
        $totalTran = count($this->transactionRepository->getAllTransactions());
        //Tổng số thành viên
        $totalMember = count($this->recruiterRepository->getAllRecruiter(''));
        //Tổng số việc làm
        $totalJob = count($this->jobRepository->getAllJob());
        //Tổng review
        $totalReview = count($this->reviewRepository->getAllReview());

        $viewData = [
            'revenueTransaction' => $revenueTransaction,
            'listMonth' => json_encode($listMonth),
            'arrRevenueTransaction' => json_encode($arrRevenueTransaction),
            'arrRevenueAccountNumber' => json_encode($arrRevenueAccountNumber),
            'totalTran' => $totalTran,
            'totalMember' => $totalMember,
            'totalJob' => $totalJob,
            'totalReview' => $totalReview



        ];
        return view('admin::index',$viewData);
    }

    public function getLogout(){
        Auth::guard('admins')->logout();
        return redirect()->route('admin.get.login')->route('admin.dashboard')->with(['flash-message'=>'Success ! Đăng xuất thành công !','flash-level'=>'success']);
    }

}
