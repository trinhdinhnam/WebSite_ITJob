<?php


namespace App\Helpers;


use App\Models\AccountPackage;

class Account
{
    public static function getListAccontId(){
        $array = AccountPackage::select('AccountPackageId')->orderBy('AccountPackageId','asc')->get()->toArray();
        return $array;
    }

}