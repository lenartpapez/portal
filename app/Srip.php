<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Srip extends Model
{
    public $timestamps = false;

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
