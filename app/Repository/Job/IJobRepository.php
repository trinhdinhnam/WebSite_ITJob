<?php
namespace App\Repository\Job;
use App\Models\Job;

interface IJobRepository
{
    /**
     * Hàm lấy danh sách thông tin đăng tuyển
     * Created_By: TDNAM()
     * @param $request: Thông tin tìm kiếm
     * @param $actor: Đối tượng gọi seeker: Người tìm việc, recruiter: Nhà tuyển dụng, admin: Admin quản trị
     * @return $jobs
     */
    public function getListJobs($request,$actor);

    /**
     * Hàm lấy danh sách thông tin đăng tuyển theo mã nhà tuyển dụng
     * Created_By: TDNAM()
     * @param $request: Thông tin tìm kiếm
     * @param $id: Mã nhà tuyển dụng
     * @return $jobs
     */
    public function getJobByRecruiterId($request,$id);

    /**
     * Hàm lấy chi tiết thông tin đăng tuyển theo mã thông tin đăng tuyển
     * Created_By: TDNAM()
     * @param $id: Mã thông tin đăng tuyển
     * @return mixed
     */
    public function getJobById($id);

    /**
     * Hàm lưu thông tin đăng tuyển khi thêm hoặc sửa
     * Created_By: TDNAM()
     * @param $jobInput: Thông tin đầu vào thông tin đăng tuyển
     * @param $id: Mã thông tin đăng tuyển
     * @return mixed
     */
    public function saveJob($jobInput, $id);

    /**
     * Hàm xóa thông tin đăng tuyển theo mã thông tin đăng tuyển
     * Created_BY: TDNAM
     * @param $id: Mã thông tin đăng tuyển
     * @return mixed
     */
    public function deleteJobById($id);

    /**
     * Hàm lấy tất cả danh sách thông tin đăng tuyển
     * Created_By: TDNAM()
     * @return $jobs
     */
    public function getAllJob();

    /**
     * Hàm lấy danh sách thông tin đăng tuyển của nhà tuyển dụng nổi bật
     * Created_By: TDNAM()
     * @param $recruiterId: Mã nhà tuyển dụng
     * @param $limit: Số bản ghi lấy ra
     * @return $jobByCompanyHot
     */
    public function getJobsByCompanyHot($recruiterId,$limit);

    /**
     * Hàm lấy danh sách thông tin đăng tuyển đã ứng tuyển của người tìm việc
     * Created_By: TDNAM()
     * @param $seekerId: Mã người tìm việc
     * @return $jobApplies
     */
    public function getJobApplies($seekerId);

    /**
     * Hàm lấy danh sách thông tin đăng tuyển theo mã vị trí
     * Created_By: TDNAM()
     * @param $positionId: Mã vị trí
     * @return mixed
     */
    public function getJobByPositions($positionId);

    /**
     * Hàm lấy danh sách thông tin đăng tuyển theo mã thành phố
     * Created_By: TDNAM()
     * @param $cityId: Mã thành phố
     * @return mixed
     */
    public function getJobByCities($cityId);

    /**
     * Hàm lấy danh sách thông tin đăng tuyển theo tên kỹ năng công việc
     * Created_By: TDNAM()
     * @param $skillName: Tên kỹ năng công việc
     * @return mixed
     */
    public function getJobBySkills($skillName);

    /**
     * Hàm lấy danh sách thông tin đăng tuyển theo phân trang
     * Created_By: TDNAM()
     * @param $request: Thông tin tìm kiếm
     * @param $recordNumber: Số bản ghi trên một trang
     * @return mixed
     */
    public function getJobByPage($request,$recordNumber);

    /**
     * Hàm lây danh sách thông tin đăng tuyển theo mã nhà tuyển dụng và có phân trang
     * Created_By: TDNAM()
     * @param $request: Thông tin tìm kiếm
     * @param $recruiterId: Mã nhà tuyển dụng
     * @param $recordNumber: Số bản ghi trên một trang
     * @return mixed
     */
    public function getJobRecruiterByPage($request,$recruiterId,$recordNumber);

    /**
     * Hàm thay đổi trạng thái thông tin nhà tuyển dụng khi Admin duyệt
     * Created_By: TDNAM()
     * @param $jobId: Mã thông tin đăng tuyển
     * @return mixed
     */
    public function changeStatus($jobId);

    /**
     * Hàm thêm thông tin đăng tuyển
     * Created_By: TDNAM()
     * @param $inputJob: Thông tin đầu vào thông tin đăng tuyển
     * @return mixed
     */
    public function createJob($inputJob);

    /**
     * Hàm cập nhật thông tin đăng tuyển
     * Created_By: TDNAM()
     * @param $inputJob: Thông tin đầu vào thông tin đăng tuyển
     * @param $jobId: Mã thông tin đăng tuyển
     * @return mixed
     */
    public function updateJob($inputJob, $jobId);

    /**
     * Hàm lấy thông báo khi nhà tuyển dụng đăng thông tin đăng tuyển
     * Created_By: TDNAM()
     * @return mixed
     */
    public function getMessagePostJob();

    /**
     * Hàm thay đổi trang thái đã xem của thông báo đăng thông tin đăng tuyển
     * @param $jobId
     * @return mixed
     */
    public function changeMessageStatus($jobId);



}