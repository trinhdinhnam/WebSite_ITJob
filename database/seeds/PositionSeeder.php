<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
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
                'PositionName' => 'Lập trình viên',
                'Description'=>'Vị trí nhân viên lập trình ',            
            ],
            [
                'PositionName' => 'Thực tập sinh/Itern',
                'Description'=>'Vị trí thực tập sinh đào tạo học việc ',            
            ],      
            [
                'PositionName' => 'Tester',
                'Description'=>'Vị trí nhân viên lập trình ',            
            ],        
            [
                'PositionName' => 'Giám đốc',
                'Description'=>'Vị trí giám đốc giám sát dự án',            
            ],    
            [
                'PositionName' => 'Leader Manager ',
                'Description'=>'Vị trí trưởng quản lý dự án',            
            ],
            ];
            \DB::table('positions')->insert($posts);
    }
}
