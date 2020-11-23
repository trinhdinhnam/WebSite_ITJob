<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \DB::table('admins')->insert([
            'AdminName' => 'Trịnh Đình Nam',
            'Email'=>'trinhnam16898@gmail.com',
            'Phone'=>'0395699933',
            'Password'=>bcrypt('162661'),
            'Active'=>1,
        ]);
        
    }
}
