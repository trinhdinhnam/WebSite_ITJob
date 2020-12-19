<?php


namespace App\Repository\Recruiter;


interface IRecruiterRepository
{
    public function getAllRecruiter();

    public function getListRecruiters();

    public function addRecruiter($input);

    public function getRecruiterById($id);

    public function deleteRecruiter($id);

    public function changeActive($id);

    public function getRecruiterHot();


}