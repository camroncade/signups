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
        Field::where('id', '=', $id)->update(['value' => $request->input('value')]);
    }
    
}
