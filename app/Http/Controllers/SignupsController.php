<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Signup;

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
}
