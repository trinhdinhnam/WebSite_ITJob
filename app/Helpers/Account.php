<?php


namespace App\Helpers;


use App\Models\AccountPackage;

class Account
{
    public static function getListAccountId(){
        $array = AccountPackage::select('AccountPackageId','AccountPackageName')->orderBy('AccountPackageId','asc')->get()->toArray();
        return $array;
    }

}