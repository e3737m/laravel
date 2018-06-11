<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model{

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
}
