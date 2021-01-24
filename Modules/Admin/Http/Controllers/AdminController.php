<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Account;
use App\Helpers\Date;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\Seeker\ISeekerRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends AdminBaseController
{
    public $transactionRepository;
    public $recruiterRepository;
    public $reviewRepository;
    public $jobRepository;
    public $companyImageRepository;
    public $seekerRepository;
    public function __construct(ITransactionRepository $transactionRepository,IRecruiterRepository $recruiterRepository,IReviewRepository $reviewRepository,IJobRepository $jobRepository,ISeekerJobRepository $seekerJobRepository,ICompanyImageRepository $companyImageRepository, ISeekerRepository $seekerRepository)
    {
        parent::__construct($transactionRepository,$jobRepository);
        $this->transactionRepository = $transactionRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->reviewRepository = $reviewRepository;
        $this->jobRepository = $jobRepository;
        $this->companyImageRepository = $companyImageRepository;
        $this->seekerRepository = $seekerRepository;
    }

    public function index()
    {
        $this->getDataShared();

        $listMonth = Date::getListMonthInYear();
        $revenueTransaction = $this->transactionRepository->getRevenueTransactionMonth();
        $arrRevenueTransaction = [];
        foreach ($listMonth as $month){
            $totalMoney = 0;
            $totalRecruiter = 0;
            foreach ($revenueTransaction as $key => $revenue){
                if($revenue['month'] == $month){
                    $totalMoney = $revenue['totalMoney'];
                    $totalRecruiter = $revenue['totalRecruiter'];
                    break;
                }
            }
            $arrRevenueTransaction[] = $totalMoney;
            $arrRevenueRecruiter[] = $totalRecruiter;
        }

        $listAccount = Account::getListAccountId();
        $revenueAccountNumber = $this->transactionRepository->getRevenueAccountNumber('array');
        $arrRevenueAccountNumber = [];
        foreach ($listAccount as $account){
            $count[0] = $account['AccountPackageName'];
            $count[1] = 0;
            $count[2] = false;
            $count[3] = '';
            foreach ($revenueAccountNumber as $key2 => $revenue){

                if($revenue['accountName'] == $account['AccountPackageName']){
                    $count[1] = $revenue['accountNumber'];
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

        //Tổng số người tìm việc
        $totalSeeker = count($this->seekerRepository->getAllSeeker());

        //Thống kê danh sách giao dịch mới nhất
        $transactions = $this->transactionRepository->getTransactionByPage(5);

        //Thống kê các gói dịch vụ hot nhất
        $accountPackageHot = $this->transactionRepository->getRevenueAccountNumber('');
        $viewData = [
            'revenueTransaction' => $revenueTransaction,
            'listMonth' => json_encode($listMonth),
            'arrRevenueTransaction' => json_encode($arrRevenueTransaction),
            'arrRevenueRecruiter' => json_encode($arrRevenueRecruiter),
            'arrRevenueAccountNumber' => json_encode($arrRevenueAccountNumber),
            'totalTran' => $totalTran,
            'totalMember' => $totalMember,
            'totalJob' => $totalJob,
            'totalReview' => $totalReview,
            'transactions' => $transactions,
            'accountPackageHot' => $accountPackageHot



        ];
        return view('admin::index',$viewData);
    }

    public function getLogout(){
        Auth::guard('admins')->logout();
        return redirect()->route('admin.get.login')->with(['flash-message'=>'Success ! Đăng xuất thành công !','flash-level'=>'success']);
    }

    public function getRecruiterByMessage($recruitrerId,$transactionId){
        $this->getDataShared();
        $imageCompanies='';
        $recruiterDetail='';
        if($this->transactionRepository->changeMessageStatus($transactionId)){
            $imageCompanies = $this->companyImageRepository->getCompanyImageById($recruitrerId,'');
            $recruiterDetail = $this->recruiterRepository->getRecruiterById($recruitrerId);
        }
        $viewData = [
            'recruiterDetail' =>$recruiterDetail,
            'imageCompanies' => $imageCompanies
        ];
        return view('admin::recruiter.detail',$viewData);
    }

    public function getJobByMessage($jobId){
        $this->getDataShared();
        $jobDetail='';
        $imageCompanies='';
        if($this->jobRepository->changeMessageStatus($jobId)){
            $jobDetail = $this->jobRepository->getJobById($jobId);
            $imageCompanies = $this->companyImageRepository->getCompanyImageById($jobDetail->recruiter->id,'');
        }
        $viewData = [
            'jobDetail' =>$jobDetail,
            'imageCompanies' => $imageCompanies
        ];
        return view('admin::job.job_detail',$viewData);
    }

}
