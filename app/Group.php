<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function signup()
    {
        return $this->belongsTo(Signup::class);
    }
}
