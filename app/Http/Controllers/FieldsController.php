<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Field;

class FieldsController extends Controller
{
    public function update(Request $request, $id)
    {
        $updatable = [
            'value',
            'name',
            'description',
        ];

        $field = Field::find($id);

        foreach ($request->all() as $name => $value)
        {
            if (in_array($name, $updatable))
                $field->$name = $value;
        }
        $field->save();
    }
    
}
