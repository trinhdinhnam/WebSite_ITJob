<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Repository\City\ICityRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Review\IReviewRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Skill\ISkillRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends BaseController
{
    
    public $reviewRepository;
    public $recruiterRepository;
    public function __construct(ISeekerJobRepository $seekerJobRepository, IPositionRepository $positionRepository, IJobRepository $jobRepository, ICityRepository $cityRepository, IRecruiterRepository $recruiterRepository,IReviewRepository $reviewRepository,ISkillRepository $skillRepository)
    {
        parent::__construct($seekerJobRepository, $positionRepository, $jobRepository, $cityRepository, $recruiterRepository,$skillRepository);
        $this->reviewRepository = $reviewRepository;
        $this->recruiterRepository = $recruiterRepository;
    }

    public function saveReview(Request $request,$id){
         if($request)
           {
              $this->reviewRepository->addReview($request,$id,Auth::guard('seekers')->user()->id);
              $this->recruiterRepository->updateReview($id,$request->score_review);
               return redirect()->route('client.get.job.by.company',$id)->with('success','Bạn đã gửi đánh giá thành công!');
           }
        return redirect()->back()->with('danger','Bạn chưa gửi được đánh giá!');

    }
}
