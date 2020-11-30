<?php

use Illuminate\Database\Seeder;

class TranSeeder extends Seeder
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
                'PayDate'=>date("2020-11-23"),
                'ExpiryDate'=>date("2020-12-23"),
                'RecruiterId'=>5,
                'AccountPackageId'=>1,
                'created_at'=>new DateTime('now')         


            ],
            [
                'PayDate'=>date("2020-11-15"),
                'ExpiryDate'=>date("2020-12-15"),
                'RecruiterId'=>6,
                'AccountPackageId'=>3,
                'created_at'=>new DateTime('now')         
            
            ],    
            [
                'PayDate'=>date("2020-11-26"),
                'ExpiryDate'=>date("2020-12-26"),
                'RecruiterId'=>7,
                'AccountPackageId'=>4,
                'created_at'=>new DateTime('now')         
            ],        
           
            ];
            \DB::table('transactions')->insert($posts);
    }
}
