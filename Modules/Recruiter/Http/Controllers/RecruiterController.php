<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Helpers\Account;
use App\Helpers\Date;
use App\Helpers\Job;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RecruiterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public $transactionRepository;
    public $recruiterRepository;
    public $reviewRepository;
    public $jobRepository;
    public $seekerJobRepository;
    public function __construct(ITransactionRepository $transactionRepository,IRecruiterRepository $recruiterRepository,IReviewRepository $reviewRepository,IJobRepository $jobRepository,ISeekerJobRepository $seekerJobRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->reviewRepository = $reviewRepository;
        $this->jobRepository = $jobRepository;
        $this->seekerJobRepository = $seekerJobRepository;

    }
    public function index()
    {
        $listMonth = Date::getListMonthInYear();
        $revenueTransaction = $this->transactionRepository->getRevenueTransactionMoth();

        $revenueProfile = $this->seekerJobRepository->getRevenueProfile(Auth::guard('recruiters')->user()->id);

        $arrRevenueProfile = [];
        foreach ($listMonth as $month){
            $count = 0;
            foreach ($revenueProfile as $key => $revenue){
                if($revenue['month'] == $month){
                    $count = $revenue['profileNumber'];
                    break;
                }
            }
            $arrRevenueProfile[] = $count;
        }


        //Thống kê sử dụng gói dịch vụ

        $listJob = Job::getListJobId(Auth::guard('recruiters')->user()->id);
        $revenueProfileByJob = $this->seekerJobRepository->getRevenueProfileByJob(Auth::guard('recruiters')->user()->id);
        $arrRevenueProfileByJob = [];
        foreach ($listJob as $key1 => $account){
            $count = [];
            foreach ($revenueProfileByJob as $key2 => $revenue){
                if($revenue['JobId'] == $account['JobId']){
                    $count[0] = $revenue['JobName'];
                    $count[1] = $revenue['profileNumber'];
                    $count[2] = false;
                    $count[3] = '';
                    break;
                }
            }
            $arrRevenueProfileByJob[] = $count;
        }

        //Tổng số giao dịch
        $totalTran = count($this->transactionRepository->getListTransactionByRecruierId(Auth::guard('recruiters')->user()->id));
        //Tổng số thành viên
        $totalSeeker = count($this->seekerJobRepository->getSeekerByRecruiter(Auth::guard('recruiters')->user()->id));
        //Tổng số việc làm
        $totalJob = count($this->jobRepository->getJobByRecruiterId('',Auth::guard('recruiters')->user()->id));
        //Tổng review
        $totalReview = count($this->reviewRepository->getReviewByRecruiter(Auth::guard('recruiters')->user()->id));

        $viewData = [
            'revenueTransaction' => $revenueTransaction,
            'listMonth' => json_encode($listMonth),
            'listJob' => json_encode($listJob),
            'arrRevenueProfile' => json_encode($arrRevenueProfile),
            'arrRevenueProfileByJob' => json_encode($arrRevenueProfileByJob),
            'totalTran' => $totalTran,
            'totalSeeker' => $totalSeeker,
            'totalJob' => $totalJob,
            'totalReview' => $totalReview
        ];
        return view('recruiter::index',$viewData);
    }

}
