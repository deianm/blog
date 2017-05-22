<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Gate;

class JwtController extends Controller
{

    public function index()
    {
        return view('jwt.index');
    }

}