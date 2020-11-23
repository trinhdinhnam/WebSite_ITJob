<?php

use Illuminate\Database\Seeder;

class RecruiterLevelSeeder extends Seeder
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
                'RecruiterLevelName' => 'Vip 1',
                'Price'=>4600000,
                'PostNumber'=>100            
            ],
            [
                'RecruiterLevelName' => 'Vip 2',
                'Price'=>3400000,
                'PostNumber'=>80            
            ],       
            [
                'RecruiterLevelName' => 'Vip 3',
                'Price'=>2700000,
                'PostNumber'=>60            
            ],       
            [
                'RecruiterLevelName' => 'Normal ',
                'Price'=>1400000,
                'PostNumber'=>30            
            ],        
           
            ];
            \DB::table('recruiter_levels')->insert($posts);
    }
}
