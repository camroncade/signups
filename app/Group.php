<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = [
        'name',
        'description',
        'signup_id',
        'sort_index',
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function signup()
    {
        return $this->belongsTo(Signup::class);
    }
}
