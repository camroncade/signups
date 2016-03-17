<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Group;

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
}