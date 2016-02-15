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
        $signup = Signup::where('slug', '=', $slug)->first();

        return view('signup.show', [
            'signup' => $signup,
        ]);
    }
}
