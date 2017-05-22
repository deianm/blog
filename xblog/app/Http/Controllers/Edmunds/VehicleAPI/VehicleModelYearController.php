<?php

namespace App\Http\Controllers\Edmunds\VehicleAPI\VehicleModelYear;

use App\Http\Controllers\Controller;

class VehicleModelYearController extends Controller
{

    public function __construct()
    {

    }

    /*
    * GET Get Car Model Year by Car Make and Model Nicenames /api/vehicle/v2/:makeNiceName/:modelNiceName/years
    *
    * @:makeNiceName  "honda"   string     : Car make niceName (you get the niceName from the Get All Car Makes endpoint in the Vehicle Makes resource)
    * @:modelNiceName "accord"  string     : Car model niceName
    * @state          "new"     enumerated : The state of the car make
    * @submodel       ""        string     : The vehicle submodel niceName
    * @category       ""        enumerated : Vehicle Category
    * @view           "basic"   enumerated : The response payload
    * @fmt            "json"    enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_car_model_year_nicename()
    {

    }

    /*
    * GET Get Car Model Year by Car Make and Model Nicenames and the Car Year /api/vehicle/v2/:makeNiceName/:modelNiceName/:year
    *
    * @:makeNiceName  "honda"   string     : Car make niceName (you get the niceName from the Get All Car Makes endpoint in the Vehicle Makes resource)
    * @:modelNiceName "accord"  string     : Car model niceName
    * @:year          "2013"    string     : Car model niceName
    * @state          "new"     enumerated : The state of the car make
    * @submodel       ""        string     : The vehicle submodel niceName
    * @category       ""        enumerated : Vehicle Category
    * @view           "basic"   enumerated : The response payload
    * @fmt            "json"    enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_car_model_year_model_nicename()
    {

    }

    /*
    * GET Get Car Model Years Count by Vehicle Make and Model Nicenames /api/vehicle/v2/:makeNiceName/:modelNiceName/years/count
    *
    * @:makeNiceName  "honda"   string     : Car make niceName (you get the niceName from the Get All Car Makes endpoint in the Vehicle Makes resource)
    * @:modelNiceName "accord"  string     : Car model niceName
    * @state          "new"     enumerated : The state of the car make
    * @view           "basic"   enumerated : The response payload
    * @fmt            "json"    enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_car_model_year_count()
    {

    }

}