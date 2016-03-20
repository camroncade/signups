<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Signup;
use App\Group;
use App\Field;

class SignupsController extends Controller
{
    public function show($slug)
    {
        return view('signup.show', [
            'signup' => Signup::where('slug', '=', $slug)->first(),
        ]);
    }

    public function edit($slug)
    {
        return view('signup.edit', [
            'signup' => Signup::where('slug', '=', $slug)->first(),
        ]);
    }

    public function update(Request $request, $slug)
    {
        $updatable = [
            'name',
            'description', 
        ];

        $signup = Signup::find($request->id);
        
        foreach ($request->all() as $name => $value) {
            if (in_array($name, $updatable))
                $signup->$name = $value;
        }
        $signup->save();
    }

    public function create()
    {
        return view('signup.create');
    }

    public function store(Request $request)
    {
        if ( ! $request->has('name') || ! $request->has('slug'))
            return redirect()->back();

        $signup = Signup::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        // go ahead and populate it with one empty group with one empty field
        $group = Group::create([
            'name' => '',
            'signup_id' => $signup->id, 
            'sort_index' => '0',
        ]);

        Field::create([
            'name' => '',
            'description' => '',
            'group_id' => $group->id,
            'sort_index' => '0',
        ]);

        return redirect('/' . $signup->slug . '/edit');
        
    }
}
