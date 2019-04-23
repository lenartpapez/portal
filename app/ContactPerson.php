<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{

    public $timestamps = false;

    public function contactable() {
        return $this->morphTo();
    }
}
