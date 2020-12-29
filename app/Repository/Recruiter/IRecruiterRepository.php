<?php


namespace App\Repository\Recruiter;


interface IRecruiterRepository
{
    public function getAllRecruiter($request);

    public function getListRecruiters($recordNumber='');

    public function addRecruiter($input);

    public function getRecruiterById($id);

    public function deleteRecruiter($id);

    public function changeActive($id);

    public function getRecruiterHot();

    public function updateReview($recruiterId,$scoreReview);

    public function changInfoRecruiter($inputRecruiter,$recruiterId);

    public function changePassRecruiter($password,$recruiterId);

    public function getRecruiterByPage($request,$recordNumber);

    public function reducePostNumber($recruiterId);
}