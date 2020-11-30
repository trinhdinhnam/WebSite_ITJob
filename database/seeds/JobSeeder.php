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
                'LanguageId'=>4,
                'PositionId'=>1,
                'Require'=>'Yêu cầu 1 năm kinh nghiệp lập trình bằng Android các ứng dụng Mobile',
                'Description'=>'Bạn sẽ được làm việc trong một mội trường năng động cùng các đãi ngộ vô cùng hấp dẫn',
                'Salary'=>13000000,
                'Address'=>'Ngõ 18, Lê Trọng Tấn',
                'City'=>'Hà Nội',
                'StartDateApply'=>date("2020-11-21"),
                'EndDateApply'=>date("2020-12-03"),
                'AdminId'=>1,
                'RecruiterId'=>5
            ],
            [
                'JobName' => 'Senior Manager C#',
                'LanguageId'=>1,
                'PositionId'=>5,
                'Require'=>'Yêu cầu có kinh nghiệm teamlead 2 năm trong các dự án lớn, năng nổ nhiệt tình',
                'Description'=>'Bạn sẽ được làm việc trong một mội trường năng động cùng các đãi ngộ vô cùng hấp dẫn, sẽ được tăng lương 6 tháng 1 lần',
                'Salary'=>27000000,
                'Address'=>'Số 3, đường Minh Khai, Quận Tân Bình',
                'City'=>'TP Hồ Chí Minh',
                'StartDateApply'=>date("2020-10-29"),
                'EndDateApply'=>date("2020-11-29"),
                'AdminId'=>1,
                'RecruiterId'=>6
            ],       
            [
                'JobName' => 'Thực tập sinh PHP Laravel',
                'LanguageId'=>3,
                'PositionId'=>2,
                'Require'=>'Yêu cầu năm chắc kiến thức về HTML,CSS biết về OOP, và PHP',
                'Description'=>'Bạn sẽ được làm việc trong môi trường năng động, được các mentor hướng đẫn nhiệt tình, dược đi du lịch và thưởng lễ như nhân viên',
                'Salary'=>3000000,
                'Address'=>'Số 27, phố Yên Hòa, Quận Cầu Giấy',
                'City'=>'Hà Nội',
                'StartDateApply'=>date("2020-12-21"),
                'EndDateApply'=>date("2021-01-03"),
                'AdminId'=>1,
                'RecruiterId'=>7
            ],      
            [
                'JobName' => 'Thực tập sinh lập trình Python',
                'PositionId'=>2,
                'LanguageId'=>2,
                'Require'=>'Yêu cầu năm chắc kiến thức về HTML,CSS biết về OOP, nhiệt tình, có sự cầu tiến trong công việc',
                'Description'=>'Bạn sẽ được hướng đẫn đến khi được vào dự án, có thể trở thành nhân viên sau 2 tháng đào tạo',
                'Salary'=>3500000,
                'Address'=>'Số 15, đường Phạm Hùng',
                'City'=>'Hà Nội',
                'StartDateApply'=>date("2020-12-02"),
                'EndDateApply'=>date("2020-12-23"),
                'AdminId'=>1,
                'RecruiterId'=>6
            ],       
            [
                'JobName' => 'Nhân viên lập trình back-end với Java Core',
                'PositionId'=>1,
                'LanguageId'=>5,
                'Require'=>'Yêu cầu 1 năm kinh nghiệp lập trình bằng Java',
                'Description'=>'Bạn sẽ trở thành nhân viên của một công ty lớn với môi trường thoải mái',
                'Salary'=>16000000,
                'Address'=>'Số 3, đường Nam Kỳ Khởi Nghĩa, Quận Hai Bà Trưng',
                'City'=>'TP Đà Nẵng',
                'StartDateApply'=>date("2020-12-01"),
                'EndDateApply'=>date("2020-12-23"),
                'AdminId'=>1,
                'RecruiterId'=>8
            ],
            ];
            \DB::table('jobs')->insert($posts);
    }
}
