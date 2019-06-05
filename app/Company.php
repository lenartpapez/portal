<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use Sortable;

    public $timestamps = false;
    protected $fillable = ['name', 'short', 'website'];
    public $sortable = ['name'];

    public function goals()
    {
        return $this->belongsToMany('App\Goal')->withPivot('help', 'investment_plan');
    }

    public function contacts() {
        return $this->morphMany('App\ContactPerson', 'contactable');
    }
}
