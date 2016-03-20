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

    public function updateSort(Request $request)
    {
        if ($request->has('sort')) {
            $newOrder = json_decode($request->input('sort'));

            foreach ($newOrder as $field) {
                Field::where('id', '=', $field->id)
                     ->update(['sort_index' => $field->index]);
            }
        }
    }

    public function store(Request $request)
    {
        if ( ! $request->has('groupId'))
            return response('Needs a group id to create field!', 400);

        $field = Field::create([
                    'name' => '',
                    'description' => '',
                    'value' => '',
                    'group_id' => $request->input('groupId'),
                ]);

        if ($request->has('sort_index'))
        {
            $field->sort_index = $request->input('sort_index');
            $field->save();
        }

        return $field;
    }

    public function destroy(Request $request)
    {
        if ( ! $request->has('id')) 
            return response('Needs a field id to delete a field!', 400);

        return Field::destroy($request->input('id'));
    }

}
