<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = [
            [
                'JobName' => 'Nhân viên lập trình Android',
                'Possition'=>'Nhân viên',
                'LanguageId'=>7,
                'Require'=>'Yêu cầu 1 năm kinh nghiệp lập trình bằng Android các ứng dụng Mobile',
                'Description'=>'Bạn sẽ được làm việc trong một mội trường năng động cùng các đãi ngộ vô cùng hấp dẫn',
                'Salary'=>13000000,
                'Address'=>'Hà Nội',
                'StartDateApply'=>date("2020-11-21"),
                'EndDateApply'=>date("2020-12-03"),
                'CompanyId'=>2,
                'AdminId'=>1,
                'RecruiterId'=>2
            ],
            [
                'JobName' => 'Senior Manager C#',
                'Possition'=>'Senior',
                'LanguageId'=>4,
                'Require'=>'Yêu cầu có kinh nghiệm teamlead 2 năm trong các dự án lớn, năng nổ nhiệt tình',
                'Description'=>'Bạn sẽ được làm việc trong một mội trường năng động cùng các đãi ngộ vô cùng hấp dẫn, sẽ được tăng lương 6 tháng 1 lần',
                'Salary'=>27000000,
                'Address'=>'TP Hồ Chí Minh',
                'StartDateApply'=>date("2020-10-29"),
                'EndDateApply'=>date("2020-11-29"),
                'CompanyId'=>1,
                'AdminId'=>1,
                'RecruiterId'=>3
            ],       
            [
                'JobName' => 'Thực tập sinh PHP Laravel',
                'Possition'=>'Thực tập sinh',
                'LanguageId'=>6,
                'Require'=>'Yêu cầu năm chắc kiến thức về HTML,CSS biết về OOP, và PHP',
                'Description'=>'Bạn sẽ được làm việc trong môi trường năng động, được các mentor hướng đẫn nhiệt tình, dược đi du lịch và thưởng lễ như nhân viên',
                'Salary'=>3000000,
                'Address'=>'Hà Nội',
                'StartDateApply'=>date("2020-12-21"),
                'EndDateApply'=>date("2021-01-03"),
                'CompanyId'=>3,
                'AdminId'=>1,
                'RecruiterId'=>3
            ],      
            [
                'JobName' => 'Thực tập sinh lập trình Python',
                'Possition'=>'Thực tập sinh',
                'LanguageId'=>5,
                'Require'=>'Yêu cầu năm chắc kiến thức về HTML,CSS biết về OOP, nhiệt tình, có sự cầu tiến trong công việc',
                'Description'=>'Bạn sẽ được hướng đẫn đến khi được vào dự án, có thể trở thành nhân viên sau 2 tháng đào tạo',
                'Salary'=>3500000,
                'Address'=>'Hà Nội',
                'StartDateApply'=>date("2020-12-02"),
                'EndDateApply'=>date("2020-12-23"),
                'CompanyId'=>1,
                'AdminId'=>1,
                'RecruiterId'=>2
            ],       
            [
                'JobName' => 'Nhân viên lập trình back-end với Java Core',
                'Possition'=>'Nhân viên',
                'LanguageId'=>8,
                'Require'=>'Yêu cầu 1 năm kinh nghiệp lập trình bằng Java',
                'Description'=>'Bạn sẽ trở thành nhân viên của một công ty lớn với môi trường thoải mái',
                'Salary'=>16000000,
                'Address'=>'TP Hồ Chí Minh',
                'StartDateApply'=>date("2020-12-01"),
                'EndDateApply'=>date("2020-12-23"),
                'CompanyId'=>2,
                'AdminId'=>1,
                'RecruiterId'=>2
            ],
            ];
            \DB::table('jobs')->insert($posts);
    }
}
