<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;
    protected $fillable = ['contact_name', 'name', 'short', 'email'];

    public function goals()
    {
        return $this->belongsToMany('App\Goal')->withPivot('help', 'investment_plan');
    }
}
