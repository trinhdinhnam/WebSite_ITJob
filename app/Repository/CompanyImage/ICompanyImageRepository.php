<?php


namespace App\Repository\CompanyImage;


interface ICompanyImageRepository
{
    /**
     * Hàm thêm ảnh công ty vào khi nhà tuyển dụng đăng ký tài khoản
     * Created_at: TDNAM()
     * @param $input: Danh sách thông tin đầu vào
     * @param $recruiterId: mã nhà tuyển dụng
     * @return true/false
     */
    public function addCompanyImage($input,$recruiterId);

    /**
     * Hàm lấy ảnh công ty theo mã nhà tuyển dụng
     * Created_at: TDNAM()
     * @param $recruiterId: Mã nhà tuyển dụng.
     * @param $limit: Số bản ghi lấy ra
     * @return $companyImageById
     */
    public function getCompanyImageById($recruiterId,$limit);

    /**
     * Hàm thay đổi ảnh công ty
     * Created_at: TDNAM()
     * @param $inputImage: Đầu vào thông tin ảnh thay đổi
     * @param $recruiterId: Mã nhà tuyển dụng
     * @return true/false
     */
    public function changeImageCompany($inputImage,$recruiterId);

}