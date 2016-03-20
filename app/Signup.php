<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{

    protected $fillable = [
        'name',
        'slug'
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
