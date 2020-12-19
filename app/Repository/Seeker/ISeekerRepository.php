<?php


namespace App\Repository\Seeker;


interface ISeekerRepository
{
    public function getSeekerByJob($jobId);

    public function getSeekerDetail();

    public function addSeeker($seekerInput);

    public function changeInfoSeeker($seekerInput,$seekerId);

    public function changPasswordSeeker($seekerInput,$seekerId);

}