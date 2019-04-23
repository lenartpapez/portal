<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'short', 'website'];

    public function goals()
    {
        return $this->belongsToMany('App\Goal')->withPivot('help', 'investment_plan');
    }

    public function contacts() {
        return $this->morphMany('App\ContactPerson', 'contactable');
    }
}
