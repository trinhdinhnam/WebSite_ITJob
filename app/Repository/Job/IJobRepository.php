<?php


namespace App\Repository\Job;


use App\Models\Job;

interface IJobRepository
{
    public function getListJobs($request,$actor);

    public function getJobByRecruiterId($id);

    public function getJobById($id);

    public function saveJob($jobInput, $id='');

    public function deleteJobById($id);

    public function getAllJob();

    public function getJobsByCompanyHot($recruiterId,$limit);

    public function getJobApplies($seekerId);

    public function getJobByPositions($positionId);

    public function getJobByCities($cityId);

}