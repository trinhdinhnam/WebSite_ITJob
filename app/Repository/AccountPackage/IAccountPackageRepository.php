<?php


namespace App\Repository\AccountPackage;


interface IAccountPackageRepository
{
    public function getListAccountPackages();

    public function getAccountPackageById($accountId);

}