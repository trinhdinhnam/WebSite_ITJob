<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Admin;
use App\Models\Job;
use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\Seeker\ISeekerRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminStatisticalController extends AdminBaseController
{

    public $transactionRepository;
    public $jobRepository;
    public $recruiterRepository;
    public $reviewRepository;
    public $seekerRepository;
    public function __construct(ITransactionRepository $transactionRepository,IJobRepository $jobRepository,IRecruiterRepository $recruiterRepository,IReviewRepository $reviewRepository, ISeekerRepository $seekerRepository)
    {
        parent::__construct($transactionRepository,$jobRepository);
        $this->transactionRepository = $transactionRepository;
        $this->jobRepository = $jobRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->reviewRepository = $reviewRepository;
        $this->seekerRepository = $seekerRepository;
    }

    public function getRevenue(){
        $this->getDataShared();

        $transactions = $this->transactionRepository->getTransactionByPage(10);
        $viewData = [
            'transactions' => $transactions,
        ];
       return view('admin::statistical.revenue',$viewData);
   }


   public function getJob(){
       $this->getDataShared();

       $jobs = $this->jobRepository->getJobByPage('',10);
       $viewData = [
           'jobs' => $jobs,
       ];
       return view('admin::statistical.job',$viewData);
   }

   public function getMember(){
       $this->getDataShared();

       $recruiters = $this->recruiterRepository->getRecruiterByPage('',10);
       $viewData = [
           'recruiters' => $recruiters,
       ];
       return view('admin::statistical.member',$viewData);
   }

   public function getReview(){
       $this->getDataShared();

       $reviews = $this->reviewRepository->getReviewByPage(10);
       $viewData = [
           'reviews' => $reviews,
       ];
       return view('admin::statistical.review',$viewData);
   }

   public function getSeeker(){
       $this->getDataShared();
       $seekers = $this->seekerRepository->getSeekerByPage(5);
       $viewData = [
           'seekers' => $seekers,
       ];
       return view('admin::statistical.seeker',$viewData);

   }
}
