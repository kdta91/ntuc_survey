<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespondentQuestionAnswer extends Model
{
    protected $fillable = [
        'respondent_id', 'question_id', 'question_choice_id', 'others'
    ];

    public function respondent()
    {
        return $this->belongsTo(Respondent::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function questionChoice()
    {
        return $this->belongsTo(QuestionChoice::class);
    }
}
