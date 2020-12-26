<?php


namespace App\Repository\SeekerJob;


interface ISeekerJobRepository
{
    public function getSeekerByJob($id);

    public function getSeekerDetail($id);

    public function deleteSeekerJobById($id);

    public function getSeekerJobById($id);

    public function changeStatusById($id);

    public function changeMessageStatusById($jobId,$seekerId);

    public function addCVApply($seekerJobInput,$jobId);

    public function getMessageNumber();

    public function getMessageInfo();

    public function getSeekerByRecruiter($recruiterId);

    public function getRevenueProfile($recruiterId);

    public function getRevenueProfileByJob($recruiterId);

}