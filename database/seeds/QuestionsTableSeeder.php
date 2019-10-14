<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'question' => 'Are you enquiring for yourself or for your company?'
            ],
            [
                'question' => 'How do you know about NTUC LearningHub courses?'
            ],
            [
                'question' => 'Courses that you are interested to find out more. <span class="instruction">(Can select more than 1)</span>'
            ],
            [
                'question' => 'We would like to seek your consent for sending marketing/promotional updates and materials to you under the Personal Data Protection Act 2012 (PDPA) <br> I would like to receive updates from NTUC LearningHub via:'
            ],
            [
                'question' => 'Course Consultant <span class="instruction">(optional)</span>'
            ]
        ]);
    }
}
