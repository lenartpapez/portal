<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function srip()
    {
        return $this->belongsTo(Srip::class);
    }
}
