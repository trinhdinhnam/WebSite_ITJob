<?php

use Illuminate\Database\Seeder;

class AccountPackageSeeder extends Seeder
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
                'AccountPackageName' => 'Vip 1',
                'Price'=>4600000,
                'PostNumber'=>100,
                'created_at'=>new DateTime('now')         
            ],
            [
                'AccountPackageName' => 'Vip 2',
                'Price'=>3400000,
                'PostNumber'=>80,    
                'created_at'=>new DateTime('now')         

            ],       
            [
                'AccountPackageName' => 'Vip 3',
                'Price'=>2700000,
                'PostNumber'=>60,
                'created_at'=>new DateTime('now')         
            
            ],       
            [
                'AccountPackageName' => 'Normal ',
                'Price'=>1400000,
                'PostNumber'=>30,
                'created_at'=>new DateTime('now')         
            
            ],        
           
            ];
            \DB::table('account_packages')->insert($posts);
    }
}
