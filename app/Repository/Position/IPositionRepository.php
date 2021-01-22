<?php


namespace App\Repository\Position;


interface IPositionRepository
{
    /**
     * Hàm lấy danh sách vị trí công việc
     * Created_By: TDNAM()
     * @return $positions
     */
    public function getListPositions();

}