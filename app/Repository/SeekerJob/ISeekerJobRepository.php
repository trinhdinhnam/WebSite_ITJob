<?php


namespace App\Repository\SeekerJob;


interface ISeekerJobRepository
{
    public function getSeekerByJob($id);

    public function getListSeekerByRecruiter($recruiterId,$request);

    public function getSeekerDetail($id);

    public function deleteSeekerJobById($id);

    public function getSeekerJobById($id);

    public function changeStatusById($id);

    public function changeMessageStatusById($jobId,$seekerId);

    public function changeMessageApplyStatusById($jobId,$seekerId);

    public function addCVApply($seekerJobInput,$jobId);

    public function getMessageNumber($seekerId);

    public function getMessageInfo($seekerId);

    public function getSeekerByRecruiter($recruiterId,$recordNumber);

    public function getRevenueProfile($recruiterId);

    public function getRevenueProfileByJob($recruiterId);


}