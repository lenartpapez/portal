<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Institute extends Model
{
    use Sortable;

    public $timestamps = false;
    protected $fillable = ['name', 'short', 'website'];
    public $sortable = ['name'];
    protected $appends = ['fp3', 'fp4'];

    public function goals()
    {
        return $this->belongsToMany('App\Goal')->withPivot('services', 'possibilities');
    }

    public function contacts() {
        return $this->morphMany('App\ContactPerson', 'contactable');
    }

    public function getFP3Attribute() {
        foreach($this->goals as $goal) {
            if($goal->field->srip->id == 1) {
                return true;
            }
        }
        return false;
    }

    public function getFP4Attribute() {
        foreach($this->goals as $goal) {
            if($goal->field->srip->id == 2) {
                return true;
            }
        }
        return false;
    }
    
}
