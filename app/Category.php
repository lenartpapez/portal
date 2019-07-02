<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false;

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
