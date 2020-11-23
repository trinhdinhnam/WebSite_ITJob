<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
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
            'LanguageName' => 'C# .NET',
            'Description'=>'Ngôn ngữ lập trình C# giúp lập trình các ứng dụng web API restful',            
        ],
        [
            'LanguageName' => 'Python',
            'Description'=>'Ngôn ngữ lập trình Python',            
        ],        
        [
            'LanguageName' => 'PHP',
            'Description'=>'Ngôn ngữ lập trình bậc cao PHP với các frame work mạnh mẽ như Laravel hay Magento',            
        ],        
        [
            'LanguageName' => 'Android',
            'Description'=>'Ngôn ngữ lập trình Android dùng để xây dựng các app mobile trên các thiết bị android',            
        ],        
        [
            'LanguageName' => 'Java core',
            'Description'=>'Ngôn ngữ lập trình Java core là ngôn ngữ mạnh để xây dựng những ứng dụng hệ thống',            
        ]
        ];
        \DB::table('languages')->insert($posts);
    }
}
