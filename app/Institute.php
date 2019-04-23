<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'short', 'website'];

    public function goals()
    {
        return $this->belongsToMany('App\Goal', 'institute_goal')->withPivot('services', 'possibilities');
    }

    public function contacts() {
        return $this->morphMany('App\ContactPerson', 'contactable');
    }
    
}
