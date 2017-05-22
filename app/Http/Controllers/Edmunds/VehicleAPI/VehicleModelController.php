<?php

namespace App\Http\Controllers\Edmunds\VehicleAPI\VehicleModel;

use App\Http\Controllers\Controller;

class VehicleModelController extends Controller
{

    public function __construct()
    {

    }

    /*
    * GET Get Car Model Details by Car Make and Model Nicenames /api/vehicle/v2/:makeNiceName/:modelNiceName
    *
    * @:makeNiceName  "honda"   string     : Car make niceName (you get the niceName from the Get All Car Makes endpoint in the Vehicle Makes resource)
    * @:modelNiceName "accord"  string     : Car model niceName
    * @state          "used"    enumerated : The state of the car make
    * @year           "2014"    integer    : The four-digit year of interest
    * @submodel       ""        string     : The vehicle submodel niceName
    * @category       ""        enumerated : Vehicle Category
    * @view           "basic"   enumerated : The response payload
    * @fmt            "json"    enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_model_details_make_model_nicename()
    {

    }

    /*
    * GET Get All Car Models by a Car Make Nicename /api/vehicle/v2/:makeNiceName/models
    *
    * @:makeNiceName  "bmw"     string     : Car make niceName (you get the niceName from the Get All Car Makes endpoint in the Vehicle Makes resource)
    * @state          "used"    enumerated : The state of the car make
    * @year           "2014"    integer    : The four-digit year of interest
    * @submodel       ""        string     : The vehicle submodel niceName
    * @category       "Sedan"   enumerated : Vehicle Category
    * @view           "basic"   enumerated : The response payload
    * @fmt            "json"    enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_all_models_nicename()
    {

    }

    /*
    * GET Get Car Models Count /api/vehicle/v2/:makeNiceName/models/count
    *
    * @:makeNiceName  "bmw"     string     : Car make niceName (you get the niceName from the Get All Car Makes endpoint in the Vehicle Makes resource)
    * @state          "used"    enumerated : The state of the car make
    * @year           "2014"    integer    : The four-digit year of interest
    * @submodel       ""        string     : The vehicle submodel niceName
    * @category       "Sedan"   enumerated : Vehicle Category
    * @view           "basic"   enumerated : The response payload
    * @fmt            "json"    enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_car_model_count()
    {

    }

}