<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = [
        'respondent_id', 'prize_id'
    ];

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }
}
