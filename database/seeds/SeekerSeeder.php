<?php

use Illuminate\Database\Seeder;

class SeekerSeeder extends Seeder
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
                'SeekerName' => 'Lê Văn Trường',
                'Email'=>'truong123@gmail.com',
                'Phone'=>'0848838434',
                'DateOfBirth'=>date("1998-04-17"),
                'Gender'=>1,
                'Address'=>'Số 70, Bùi Ngọc Dương, phường Thanh Nhàn, quận Hai Bà Trưng, Hà Nội',
                'Password'=>bcrypt('123456')
            ],
            [
                'SeekerName' => 'Trịnh Đình Nam',
                'Email'=>'nam168@gmail.com',
                'Phone'=>'0748844848',
                'DateOfBirth'=>date("1998-08-14"),
                'Gender'=>1,
                'Address'=>'số 103, Lê Thanh Nghị, quận Hai Bà Trưng, Hà Nội',
                'Password'=>bcrypt('123123')
            ],        
            [
                'SeekerName' => 'Đặng Thị Thùy Dung',
                'Email'=>'dung125@gmail.com',
                'Phone'=>'0984774737',
                'DateOfBirth'=>date("1999-06-21"),
                'Gender'=>0,
                'Address'=>'Số 764, Đường Láng, quận Đống Đa, Hà Nội',
                'Password'=>bcrypt('888888')
            ]       
            
            ];
            \DB::table('seekers')->insert($posts);
    }
}
