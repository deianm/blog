<?php

namespace App\Http\Controllers\Edmunds\Homepage;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {

        return view('examples.edmunds.index');

    }

}