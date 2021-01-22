<?php


namespace App\Repository\Transaction;


interface ITransactionRepository
{

    // Hàm lấy danh sách giao dịch theo mã nhà tuyển dụng
    public function getListTransactionByRecruierId($id);

    //Hàm lấy giao dịch ra theo mã giao dịch
    public function getTransactionById($id);

    //Hàm cập nhật trạng thái giao dịch khi duyệt
    public function changeStatus($id);

    //Hàm lấy ra giao dịch mới nhất của nhà tuyển dụng theo mã nhà tuyển dụng
    public function getTransactionNew($id);

    //Hàm thống kê danh sách giao dịch theo các tháng trong năm
    public function getRevenueTransactionMonth();

    //Hàm thống kê số lượng tài khoản nhà tuyển dụng của hệ thống
    public function getRevenueAccountNumber($type);

    //Hàm lấy tất cả danh sách các giao dịch
    public function getAllTransactions();

    //Hàm xóa giao dịch theo mã giao dịch
    public function deleteTransactionById($id);

    //Hàm thêm giao dịch vào hệ thống khi nhà tuyển dụng thanh toán thành công
    public function addTransaction($inputTransaction,$recruiterId,$accountId);

    //Hàm lấy danh sách giao dịch theo phân trang
    public function getTransactionByPage($recordNumber);

    //Hàm lấy danh sách giao dịch của nhà tuyển dụng theo phân trang
    public function getTransactionRecruiterByPage($recruiterId,$recordNumber);

    //Hàm lấy thông tin các thông báo duyệt giao dịch của admin
    public function getMessageTransaction();

    //Hàm thay đổi trạng thái xem thông báo giao dịch của admin
    public function changeMessageStatus($tranId);

}