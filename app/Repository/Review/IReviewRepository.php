<?php


namespace App\Repository\Review;


interface IReviewRepository
{
    public function addReview($inputReview,$recruiterId,$seekerId);

    public function getReviewByRecruiter($recruiterId);

    public function getListReviews();

    public function getListReviewHots($recruiterId);

    public function getAllReview();

}