<?php

use Illuminate\Database\Seeder;

class RecruiterSeeder extends Seeder
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
                'RecruiterName' => 'Nguyễn Tuấn Anh',
                'Email'=>'tuananh11@gmail.com',
                'Phone'=>'0788384843',
                'DateOfBirth'=>date("1999-09-19"),
                'Gender'=>1,
                'Address'=>'Số 67, Yên Hòa, Cầu Giấy, Hà Nội',
                'Password'=>bcrypt('123456'),
                'RecruiterLevelId'=>1
            ],
            [
                'RecruiterName' => 'Nguyễn Thị Vân Anh',
                'Email'=>'vananh123@gmail.com',
                'Phone'=>'0399588486',
                'DateOfBirth'=>date("2000-08-14"),
                'Gender'=>0,
                'Address'=>'Số 73, Tạ Quang Bửu, quận Hai Bà Trưng, Hà Nội',
                'Password'=>bcrypt('111111'),
                'RecruiterLevelId'=>2

            ],        
            [
                'RecruiterName' => 'Lê Trung Nguyên',
                'Email'=>'nguyen123@gmail.com',
                'Phone'=>'0939848482',
                'DateOfBirth'=>date("1999-11-29"),
                'Gender'=>1,
                'Address'=>'Số 13, Phường Phú Nhuận, Quận 7, Thành Phố Hồ Chí Minh',
                'Password'=>bcrypt('777777'),
                'RecruiterLevelId'=>4

            ]       
            
            ];
            \DB::table('recruiters')->insert($posts);
    }
}
