<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name',
        'description',
        'value',
        'group_id',
        'sort_index',
    ];
}
