<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function goals()
    {
        return $this->hasMany('App\Goal');
    }
}
