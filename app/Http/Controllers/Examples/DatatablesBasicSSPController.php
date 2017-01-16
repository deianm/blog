<?php

namespace App\Http\Controllers\Examples;

use App\Classes\DatatablesClass as SSP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatatablesBasicSSPController extends Controller

{

    public function index()
    {

        return view('examples.datatables.basic-ssp');

    }

    public function allUsers(Request $request)
    {


        $dt_request = $request->all();
        $database = 'personal_db';
        $table = 'dt_basic_ssp';
        $primaryKey = 'id';

        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user', 'dt' => 1),
            array('db' => 'email', 'dt' => 2),
            array('db' => 'note', 'dt' => 3),
            array('db' => 'website', 'dt' => 4)
        );

        echo json_encode(SSP::simpleJoin($dt_request, $table, $primaryKey, $columns, $joins = null, $initFilter = null, $forceInit = false, $database));

    }


}
