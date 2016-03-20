<?php

namespace App\Http\Controllers;

use App\Group;
use App\Field;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function update(Request $request, $id)
    {
        $updatable = [
            'name',
            'description',
        ];

        $group = Group::find($id);

        foreach ($request->all() as $name => $value) {
            if (in_array($name, $updatable))
                $group->$name = $value;
        }
        $group->save();
    }

    public function updateSort(Request $request)
    {
         if ($request->has('sort')) {
             $newOrder = json_decode($request->input('sort'));

             foreach ($newOrder as $group) {
                Group::where('id', '=', $group->id)
                     ->update(['sort_index' => $group->index]);
             }
        }
    }

    public function store(Request $request)
    {
        if ( ! $request->has('signupId') )
            return response('Needs a signup id to create a group!', 400);

        $group = Group::create([
            'name' => '',
            'description' => '',
            'signup_id' => $request->input('signupId'),
        ]);

        if ($request->has('sort_index'))
        {
            $group->sort_index = $request->input('sort_index');
            $group->save();
        }

        return $group;
    }

    public function destroy(Request $request)
    {
        if ( ! $request->has('id') )
            return response('Needs a group id to destroy a group!', 400);

        Field::where('group_id', '=', $request->input('id'))->delete();

        return Group::destroy($request->input('id'));
    }

}
