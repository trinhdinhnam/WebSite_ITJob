<?php


namespace App\Repository\Job;


use App\Models\Job;

interface IJobRepository
{
    public function getListJobs($request,$actor);

    public function getJobByRecruiterId($request,$id);

    public function getJobById($id);

    public function saveJob($jobInput, $id);

    public function deleteJobById($id);

    public function getAllJob();

    public function getJobsByCompanyHot($recruiterId,$limit);

    public function getJobApplies($seekerId);

    public function getJobByPositions($positionId);

    public function getJobByCities($cityId);

    public function getJobBySkills($skillName);

    public function getJobByPage($request,$recordNumber);

    public function getJobRecruiterByPage($request,$recruiterId,$recordNumber);

    public function changeStatus($jobId);

    public function createJob($inputJob);

    public function updateJob($inputJob, $jobId);

}