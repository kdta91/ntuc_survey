<?php

use Illuminate\Database\Seeder;

class QuestionChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_choices')->insert([
            // Question number 1
            [
                'question_id' => 1,
                'choice' => 'Myself',
                'type' => 'fixed'
            ],
            [
                'question_id' => 1,
                'choice' => 'Company',
                'type' => 'fixed'
            ],
            // Question number 2
            [
                'question_id' => 2,
                'choice' => 'FaceBook / Instagram',
                'type' => 'fixed'
            ],
            [
                'question_id' => 2,
                'choice' => 'Website',
                'type' => 'fixed'
            ],
            [
                'question_id' => 2,
                'choice' => 'Others <span class="instruction">(please specify)</span>',
                'type' => 'custom'
            ],
            // Question number 3
            [
                'question_id' => 3,
                'choice' => 'Workplace Safety And Health Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Basic IT Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Security Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Service Excellence Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Soft Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Leadership Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'English Language Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Consultancy Services Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Eldercare Skills',
                'type' => 'fixed'
            ],
            [
                'question_id' => 3,
                'choice' => 'Others <span class="instruction">(please specify)</span>',
                'type' => 'custom'
            ],
            // Question number 4
            [
                'question_id' => 4,
                'choice' => 'SMS',
                'type' => 'fixed'
            ],
            [
                'question_id' => 4,
                'choice' => 'Phone Call',
                'type' => 'fixed'
            ],
            [
                'question_id' => 4,
                'choice' => 'Email',
                'type' => 'fixed'
            ],
            // Question number 5
            [
                'question_id' => 5,
                'choice' => '',
                'type' => 'custom'
            ],
        ]);
    }
}
