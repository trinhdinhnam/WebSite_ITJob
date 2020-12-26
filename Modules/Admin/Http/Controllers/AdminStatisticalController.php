<?php

namespace Modules\Admin\Http\Controllers;

use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminStatisticalController extends Controller
{

    public $transactionRepository;
    public $jobRepository;
    public $recruiterRepository;
    public $reviewRepository;
    public function __construct(ITransactionRepository $transactionRepository,IJobRepository $jobRepository,IRecruiterRepository $recruiterRepository,IReviewRepository $reviewRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->jobRepository = $jobRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function getRevenue(){
        $transactions = $this->transactionRepository->getAllTransactions();
        $viewData = [
            'transactions' => $transactions,
        ];
       return view('admin::statistical.revenue',$viewData);
   }


   public function getJob(){
       $jobs = $this->jobRepository->getAllJob();
       $viewData = [
           'jobs' => $jobs,
       ];
       return view('admin::statistical.job',$viewData);
   }

   public function getMember(){
       $recruiters = $this->recruiterRepository->getAllRecruiter('');
       $viewData = [
           'recruiters' => $recruiters,
       ];
       return view('admin::statistical.member',$viewData);
   }

   public function getReview(){
       $reviews = $this->reviewRepository->getAllReview();
       $viewData = [
           'reviews' => $reviews,
       ];
       return view('admin::statistical.review',$viewData);
   }
}
