<?php


namespace App\Helpers;


use App\Models\AccountPackage;

class Job
{

    public static function getListJobId($recruiterId){
        $array = \App\Models\Job::select('JobId','JobName')
                 ->where('jobs.RecruiterId',$recruiterId)
                 ->get()->toArray();
        return $array;
    }
}