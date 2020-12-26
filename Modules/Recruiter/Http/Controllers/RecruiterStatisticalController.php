<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Repository\Job\IJobRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\Seeker\ISeekerRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RecruiterStatisticalController extends Controller
{
    public $transactionRepository;
    public $jobRepository;
    public $recruiterRepository;
    public $reviewRepository;
    public $seekerJobRepository;
    public function __construct(ITransactionRepository $transactionRepository,IJobRepository $jobRepository,IRecruiterRepository $recruiterRepository,IReviewRepository $reviewRepository,ISeekerJobRepository $seekerJobRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->jobRepository = $jobRepository;
        $this->recruiterRepository = $recruiterRepository;
        $this->reviewRepository = $reviewRepository;
        $this->seekerJobRepository = $seekerJobRepository;
    }

    public function getTransaction($recruiterId){
        $transactions = $this->transactionRepository->getTransactionById($recruiterId);
        $viewData = [
            'transactions' => $transactions,
        ];
        return view('recruiter::statistical.revenue',$viewData);
    }


    public function getJob($recruiterId){
        $jobs = $this->jobRepository->getJobByRecruiterId('',$recruiterId);
        $viewData = [
            'jobs' => $jobs,
        ];
        return view('recruiter::statistical.job',$viewData);
    }

    public function getSeeker($recruiterId){
        $seekers = $this->seekerJobRepository->getSeekerByRecruiter($recruiterId);
        $viewData = [
            'seekers' => $seekers,
        ];
        return view('recruiter::statistical.seeker',$viewData);
    }

    public function getReview(){
        $reviews = $this->reviewRepository->getAllReview();
        $viewData = [
            'reviews' => $reviews,
        ];
        return view('recruiter::statistical.review',$viewData);
    }
}
