<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'contact_number'
    ];
}
