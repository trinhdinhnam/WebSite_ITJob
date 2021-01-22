<?php


namespace App\Repository\AccountPackage;


interface IAccountPackageRepository
{
    /**
     * Hàm lấy danh sách các gói tài khoản của hệ thống
     * Created_at: TDNAM()
     * @return $accountPackages
     */
    public function getListAccountPackages();


    /**
     * Hàm lấy một gói tài khoản theo mã gói tài khoản
     * Created_at: TDNAM()
     * @param $accountId
     * @return $accountPackage
     *
     */
    public function getAccountPackageById($accountId);

}