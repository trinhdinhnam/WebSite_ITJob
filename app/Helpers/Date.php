<?php


namespace App\Helpers;


class Date
{

    public static function getListMonthInYear(){
        $arrayMonth = [];
        $year = date('Y');
        //Lấy tất cả tháng trong năm

        for($mon = 1;$mon <= 12; $mon ++){
            $time = mktime(12,0,0,$mon,1,$year);
            if(date('Y',$time) == $year){
               $arrayMonth[] = date('m',$time);

            }
        }

        return $arrayMonth;
    }
}