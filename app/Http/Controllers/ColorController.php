<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    public function getColor()
    {
        return view('devbf/colors');
    }

    public function postColor(Request $request)
    {
        return $request;

    }
}
