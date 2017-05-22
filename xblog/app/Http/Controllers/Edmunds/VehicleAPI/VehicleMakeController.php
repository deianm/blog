<?php

namespace App\Http\Controllers\Edmunds\VehicleAPI;

use App\Http\Controllers\Edmunds\GRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{

    public function __construct()
    {

    }

    /*
    * GET Get All Car Makes /api/vehicle/v2/makes
    *
    * @state "used"   enumerated : The state of the car make  PV: new, used, future
    * @year  "2014"   integer    : The four-digit year of interest PV: 1990-current year
    * @view  "basic"  enumerated : The response payload PV: basic, full
    * @fmt   "json"   enumerated : Response format (json only) PV: json
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public static function get_all_car_makes(Request $data)
    {

        $package = [
            'state' => '&state='.'new',//$data->state,
            'year' => '&year='.'2017',//$data->year,
            'view' => '&view='.'basic',//$data->view,
            'fmt' => '&fmt=json',
            'api_key' => '&api_key='.'qbbpc2dbpjsvj23nchcbqfc2'
        ];

        $package_url = (implode($package));

        $url = 'api/vehicle/v2/makes?'.$package_url;

        $response = GRequest\GuzzleController::request_edmunds($url);

        $result = json_decode($response, true);

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);

    }

    /*
    * GET Get All Car Makes /api/vehicle/v2/:makeNiceName
    *
    * @:makeNiceName "audi"   string     : Car make niceName (you get the niceName from the Get All Car Makes endpoint)
    * @state         "used"   enumerated : The state of the car make
    * @year          "2014"   integer    : The four-digit year of interest
    * @view          "basic"  enumerated : The response payload
    * @fmt           "json"   enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_car_make_details_by_make_nicename(Request $data)
    {

        $package = [
            'make' => 'audi?', //$data->makeNiceName
            'state' => '&state='.'used',//$data->state,
            'year' => '&year='.'2013',//$data->year,
            'view' => '&view='.'basic',//$data->view,
            'fmt' => '&fmt=json',
            'api_key' => '&api_key='.'qbbpc2dbpjsvj23nchcbqfc2'
        ];

        $package_url = (implode($package));

        $url = 'api/vehicle/v2/'.$package_url;

        $response = GRequest\GuzzleController::request_edmunds($url);

        $result = json_decode($response, true);

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);

    }

    /*
    * GET Get Car Makes Count /api/vehicle/v2/makes/count
    *
    * @state "used"   enumerated : The state of the car make
    * @year  "2014"   integer    : The four-digit year of interest
    * @view  "basic"  enumerated : The response payload
    * @fmt   "json"   enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_car_makes_count(Request $data)
    {

        $package = [
            'state' => '&state='.'used',//$data->state,
            'year' => '&year='.'2005',//$data->year,
            'view' => '&view='.'basic',//$data->view,
            'fmt' => '&fmt=json',
            'api_key' => '&api_key='.'qbbpc2dbpjsvj23nchcbqfc2'
        ];

        $package_url = (implode($package));

        $url = 'api/vehicle/v2/makes/count?'.$package_url;

        $response = GRequest\GuzzleController::request_edmunds($url);

        $result = json_decode($response, true);

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);

    }

}