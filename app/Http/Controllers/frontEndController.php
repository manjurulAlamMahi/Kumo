<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontEndController extends Controller
{
    function welcome()
    {
        return view('frontend.index');
    }
}
