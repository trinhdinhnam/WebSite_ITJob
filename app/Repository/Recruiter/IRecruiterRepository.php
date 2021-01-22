<?php


namespace App\Repository\Recruiter;


interface IRecruiterRepository
{
    /**
     * Hàm lấy tất cả danh sách nhà tuyển dụng
     * Created_By: TDNAM()
     * @param $request: Thông tin tìm kiếm
     * @return mixed
     */
    public function getAllRecruiter($request);

    /**
     * Hàm lấy danh sách nhà tuyển dụng
     * Created_By: TDNAM()
     * @param string $recordNumber
     * @return mixed
     */
    public function getListRecruiters($recordNumber='');

    /**
     * Hàm theo nhà tuyển dụng vào hệ thống
     * Created_By: TDNAM()
     * @param $input: Thông tin đầu vào nhà tuyển dụng
     * @return mixed
     */
    public function addRecruiter($input);

    /**
     * Hàm lấy thông tin nhà tuyển dụng theo mã nhà tuyển dụng
     * Created_By: TDNAM()
     * @param $id
     * @return mixed
     */
    public function getRecruiterById($id);

    public function deleteRecruiter($id);

    public function changeActive($id);

    public function getRecruiterHot();

    public function updateReview($recruiterId,$scoreReview);

    public function changInfoRecruiter($inputRecruiter,$recruiterId);

    public function changePassRecruiter($password,$recruiterId);

    public function getRecruiterByPage($request,$recordNumber);

    public function reducePostNumber($recruiterId);

    public function getReviewHot();

    public function updatePostNumber($recruiterId,$postNumber);

    public function getJobNumberByRecruiter();
}