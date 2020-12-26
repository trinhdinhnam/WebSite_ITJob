<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
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
                'SkillName' => 'Java',
            ],
            [
                'SkillName' => 'PHP',
            ],
            [
                'SkillName' => 'Java',
            ],
            [
                'SkillName' => 'JavaScript',
            ],
            [
                'SkillName' => 'C#',
            ],
            [
                'SkillName' => 'HTML5',
            ],
            [
                'SkillName' => 'CSS',
            ],
            [
                'SkillName' => 'Manager',
            ],
            [
                'SkillName' => 'Android',
            ],
            [
                'SkillName' => 'IOS',
            ],
            [
                'SkillName' => 'MySql',
            ],
            [
                'SkillName' => 'Tester',
            ],
            [
                'SkillName' => 'English',
            ],
            [
                'SkillName' => 'Python',
            ],
            [
                'SkillName' => 'QA QC',
            ],
            [
                'SkillName' => '.NET',
            ],
            [
                'SkillName' => 'Database',
            ],
            [
                'SkillName' => 'Business Analyst',
            ],
            [
                'SkillName' => 'OOP',
            ],
            [
                'SkillName' => 'Oracle',
            ],
            [
                'SkillName' => 'Linux',
            ],
            [
                'SkillName' => 'MVC',
            ],
            [
                'SkillName' => 'ReactJS',
            ],
            [
                'SkillName' => 'NodeJS',
            ],
            [
                'SkillName' => 'Designer',
            ],
            [
                'SkillName' => 'Team Leader',
            ]

        ];
        \DB::table('skills')->insert($posts);
    }
}
