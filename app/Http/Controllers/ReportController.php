<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respondent;
use App\RespondentQuestionAnswer;

class ReportController extends Controller
{
    public function index()
    {
        // $survey_results = RespondentQuestionAnswer::get();

        // return view('report', compact('survey_results'));

        $this->exportRespondents();
        $this->exportAnswers();
    }

    public function exportAnswers()
    {
        $survey_results = RespondentQuestionAnswer::with('respondent')->with('question')->with('questionChoice')->get();
        $csvExporter = new \Laracsv\Export();
        $csvExporter->beforeEach(function ($survey_result) {
            $survey_result->respondent_id = $survey_result['respondent']['first_name'] . ' ' . $survey_result['respondent']['last_name'];
            $survey_result->question_id = strip_tags($survey_result['question']['question']);
            $survey_result->question_choice_id = strip_tags($survey_result['questionChoice']['choice']);
        });
        $csvExporter->build($survey_results,
            [
                'respondent_id' => 'Respondent',
                'question_id' => 'Question',
                'question_choice_id' => 'Choice',
                'others'  => 'Others'
            ])->download('Survey_Report_' . date('m-d-Y h:i:s') . '.csv');
    }

    public function exportRespondents()
    {
        $respondents = Respondent::get();
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($respondents, [
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'email' => 'Email',
                'contact_number'  => 'Contact Number'
            ])->download('Respondents_' . date('m-d-Y h:i:s') . '.csv');
    }

    public function answerPercentage()
    {
        // $question_1 = [];
        // $question_2 = [];
        // $question_3 = [];
        // $question_4 = [];
        // $question_5 = [];

        // for ($i = 1; $i <= 5; $i++) {
        //     ${'question_' . $i} = RespondentQuestionAnswer::where('question_id', $i)->get();
        // }

        // // for ($i = 0; $i < ; $i++) {
        // //     # code...
        // // }

        // print('<pre>'.print_r($question_3, true).'</pre>');
    }
}
