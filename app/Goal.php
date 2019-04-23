<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    public function field()
    {
        return $this->belongsTo('App\Field');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Company');
    }

    public function institutes()
    {
        return $this->belongsToMany('App\Institute');
    }
}
