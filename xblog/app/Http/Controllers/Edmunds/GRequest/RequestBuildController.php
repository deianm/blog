<?php

namespace App\Http\Controllers\Edmunds\GRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class RequestBuildController extends Controller
{

    public function __construct()
    {

    }


    public function fetch_endpoints(Request $fetch_endpoints)
    {

        $request = $fetch_endpoints->all();

        $search = strip_tags(trim($request['search']));

        $results = DB::table('ed_endpoints')
            ->where('id', 'LIKE', '%' . $search . '%')
            ->orWhere('endpoint', 'LIKE', '%' . $search . '%')
            ->get();

        $data = [];

        foreach ($results as $result) {

            $data[] = [
                'id' => $result->id,
                'endpoint' => '(' . $result->id . ')' . ' ' . $result->endpoint
            ];

        }

        echo json_encode($data);

    }

    public function endpoint_build(Request $request)
    {

        dd($request);

        $endpoint_id = $request->get('endpoint_id');
        $search_data = $request->get('search_data');


        $call = DB::table('ed_method_list')->where('endpoint_id', '=', $endpoint_id)->get();

        $controller = $call->ed_controller;
        $method = $call->ed_method;

        $response = $controller::$method($search_data);

        return $response;

    }

    //Generates the fields for the corresponding endpoint
    public function build_payload(Request $request)
    {

        $endpoint_id = $request->endpoint_id;

        $result = DB::table('ed_payload')->where('endpoint_id', '=', $endpoint_id)->get();

        $fields = $result[0]->payload;
        $array = explode(',', $fields);

        echo '<row><div class="col-md-12"><form>';
        foreach ($array as $field) {

            echo '<div style="margin-bottom:0!important;" class="form-group">';
            echo '<label for="' . $field . '">' . ucfirst($field) . ': </label><input class="form-control" name="' . $field . '"></br>';
            echo '</div>';

        }
        echo '</form></div></row>';

    }

    private function request_payload(Request $request)
    {

        $endpoint_id = $request->endpoint_id;


    }

}
