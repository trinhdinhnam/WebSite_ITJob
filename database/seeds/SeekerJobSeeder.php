<?php

use Illuminate\Database\Seeder;

class SeekerJobSeeder extends Seeder
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
                'JobId'=>2,
                'SeekerId'=>1,
                'created_at'=>new DateTime('now')         


            ],
            [
                'JobId'=>3,
                'SeekerId'=>2,
                'created_at'=>new DateTime('now')         


            ], 
            [
                'JobId'=>4,
                'SeekerId'=>2,
                'created_at'=>new DateTime('now')         


            ],
            [
                'JobId'=>3,
                'SeekerId'=>1,
                'created_at'=>new DateTime('now')         

            ],
            [
                'JobId'=>3,
                'SeekerId'=>3,
                'created_at'=>new DateTime('now')         


            ],        
           
            ];
            \DB::table('seeker_jobs')->insert($posts);
    }
}
