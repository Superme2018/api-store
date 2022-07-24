<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Classes

class ApiErrorController extends Controller
{
    public function missing_env_params(Request $request)
    {
        dd($request->all());
    }
}
