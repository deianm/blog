<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Gate;

class ResumeController extends Controller
{

    public function index()
    {
        return view('resume.index');
    }

}
