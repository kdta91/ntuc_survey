<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\QuestionChoice;
use App\Respondent;
use App\RespondentQuestionAnswer;

class SurveyController extends Controller
{
    public function show($page)
    {
        if ($page === '1') {
            $questions = Question::with('questionchoices')->take(3)->get();
        } else if ($page === '2') {
            $questions = Question::skip(3)->take(2)->get();
        }

        // var_dump(request()->session()->get('respondent'));
        // var_dump(request()->session()->get('answer'));

        return view('questions.page-'.$page, compact('questions'));
    }

    public function store($page)
    {
        if ($page === '1') {
            $validator = \Validator::make(request()->all(), [
                'answer_1' => 'required',
                'answer_2' => 'required',
                'answer_3' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            } else {
                $answers = [
                    '1' => request()->post('answer_1'),
                    '2' => request()->post('answer_2'),
                    '3' => request()->post('answer_3')
                ];

                request()->session()->put('answers', $answers);

                return response()->json(['success' => true, 'respondent' => request()->session()->get('respondent'), 'answers' => request()->session()->get('answers')]);
            }
        } else if ($page === '2') {
            $validator = \Validator::make(request()->all(), [
                'answer_4' => 'required',
                'answer_5' => 'nullable'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            } else {
                request()->session()->put('answers.4', request()->post('answer_4'));
                request()->session()->put('answers.5', request()->post('answer_5'));

                // Save respondent
                $respondent = Respondent::create(request()->session()->get('respondent'));
                request()->session()->put('respondent.id', $respondent->id);
                // Loop through the answers and save the answers
                $respondent_answers = request()->session()->get('answers');
                $filtered_answers = array_filter($respondent_answers);
                $insert = [];
                for ($i = 1; $i <= count($filtered_answers); $i++) {
                    if ($i === 3 || $i === 4) { // for checkbox multiple selections
                        for ($j = 0; $j < count(json_decode($filtered_answers[$i])); $j++) {
                            $decode = json_decode($filtered_answers[$i]);
                            $insert[] = [
                                'respondent_id' => $respondent->id,
                                'question_id' => $decode[$j]->question_id,
                                'question_choice_id' => $decode[$j]->question_choice_id,
                                'others' => ($decode[$j]->others) ? $decode[$j]->others : null
                            ];
                        }
                    } else {
                        $insert[] = [
                            'respondent_id' => $respondent->id,
                            'question_id' => $filtered_answers[$i]['question_id'],
                            'question_choice_id' => $filtered_answers[$i]['question_choice_id'],
                            'others' => $filtered_answers[$i]['others']
                        ];
                    }
                }

                RespondentQuestionAnswer::insert($insert);

                return response()->json(['success' => true, 'respondent' => request()->session()->get('respondent'), 'answers' => request()->session()->get('answers')]);
            }
        }
    }
}
