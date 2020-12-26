<?php


namespace App\Repository\Review;


use App\Models\Review;
use App\Repository\BaseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewRepository extends BaseRepository implements IReviewRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Review::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function addReview($inputReview, $recruiterId, $seekerId)
    {
        // TODO: Implement addReview() method.
        $review = new $this->model;
        $review->RecruiterId = $recruiterId;
        $review->SeekerId = $seekerId;
        $review->Title = $inputReview->title_review;
        $review->GoodReview = $inputReview->good_review_content;
        $review->NotGoodReview = $inputReview->notgood_review_content;
        $review->ScoreReview = $inputReview->score_review;
        $review->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $review->save();
        return true;
    }

    public function getReviewByRecruiter($recruiterId)
    {
        // TODO: Implement getReviewByRecruiter() method.
        return $this->model->where('RecruiterId',$recruiterId)
                           ->get();
    }

    public function getListReviews()
    {
        // TODO: Implement getListReviews() method.
        return $this->model->paginate(5);
    }

    public function getListReviewHots($recruiterId)
    {
        // TODO: Implement getListReviewHots() method.

        return $this->model->where('RecruiterId',$recruiterId)
                           ->where('ScoreReview',5)
                           ->orderBy('created_at','desc')
                           ->limit(5)
                           ->get();
    }

    public function getAllReview()
    {
        // TODO: Implement getAllReview() method.
        return $this->model->with('recruiter:id,RecruiterName')
                           ->with('seeker:id,SeekerName')
                           ->orderBy('created_at','desc')
                           ->get();
    }
}