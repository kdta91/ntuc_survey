<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    public function winners()
    {
        return $this->hasMany(Winner::class);
    }
}
