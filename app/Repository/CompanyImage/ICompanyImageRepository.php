<?php


namespace App\Repository\CompanyImage;


interface ICompanyImageRepository
{
    public function addCompanyImage($input,$recruiterId);

    public function getCompanyImageById($recruiterId,$limit);

}