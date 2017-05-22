<?php

namespace App\Http\Controllers\Edmunds\VehicleAPI\VehicleStyle;

use App\Http\Controllers\Controller;

class VehicleStyleController extends Controller
{

    public function __construct()
    {

    }

    /*
    * GET Get Style Details by ID /api/vehicle/v2/styles/:id
    *
    * @:id   "200487199"  string     : Edmunds vehicle style ID
    * @view  "basic"      enumerated : The response payload
    * @fmt   "json"       enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_style_by_id()
    {

    }

    /*
    * GET Get Car Model Details by Car Make and Model Nicenames /api/vehicle/v2/:makeNiceName/:modelNiceName
    *
    * @:makeNiceName  "honda"    string     : Vehicle make niceName
    * @:modelNiceName "pilot"    string     : Vehicle model niceName
    * @:year          "2010"     string     : Vehicle four-digit year
    * @state          "used"     enumerated : The state of the car make
    * @year           "2014"     integer    : The four-digit year of interest
    * @submodel       ""         string     : The vehicle submodel niceName
    * @category       "4dr SUV"  enumerated : Vehicle Category
    * @view           "basic"    enumerated : The response payload
    * @fmt            "json"     enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_style_by_v_make_model_year()
    {

    }

    /*
    * GET Get Styles Count by Vehicle Make/Model/Year /api/vehicle/v2/:makeNiceName/:modelNiceName/:year/styles/count
    *
    * @:makeNiceName  "honda"    string     : Vehicle make niceName
    * @:modelNiceName "pilot"    string     : Vehicle model niceName
    * @:year          "2010"     string     : Vehicle four-digit year
    * @state          "used"     enumerated : The state of car style
    * @fmt            "json"     enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_count_by_v_make_model_year()
    {

    }

    /*
    * GET Get Styles Count by Vehicle Make and Model /api/vehicle/v2/:makeNiceName/:modelNiceName/styles/count
    *
    * @:makeNiceName  "honda"    string     : Vehicle make niceName
    * @:modelNiceName "pilot"    string     : Vehicle model niceName
    * @:year          "2010"     string     : Vehicle four-digit year
    * @state          "used"     enumerated : The state of the car make
    * @year           "2014"     integer    : The four-digit year of interest
    * @submodel       ""         string     : The vehicle submodel niceName
    * @category       "4dr SUV"  enumerated : Vehicle Category
    * @view           "basic"    enumerated : The response payload
    * @fmt            "json"     enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_style_count_by_v_make_model()
    {

    }

    /*
    * GET Get Styles Count by Vehicle Make /api/vehicle/v2/:makeNiceName/styles/count
    *
    * @:makeNiceName  "honda"    string     : Vehicle make niceName
    * @:modelNiceName "pilot"    string     : Vehicle model niceName
    * @:year          "2010"     string     : Vehicle four-digit year
    * @state          "used"     enumerated : The state of the car make
    * @year           "2014"     integer    : The four-digit year of interest
    * @submodel       ""         string     : The vehicle submodel niceName
    * @category       "4dr SUV"  enumerated : Vehicle Category
    * @view           "basic"    enumerated : The response payload
    * @fmt            "json"     enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_style_count_by_v_make()
    {

    }

    /*
    * GET Get Styles Count /api/vehicle/v2/styles/count
    *
    * @:makeNiceName  "honda"    string     : Vehicle make niceName
    * @:modelNiceName "pilot"    string     : Vehicle model niceName
    * @:year          "2010"     string     : Vehicle four-digit year
    * @state          "used"     enumerated : The state of the car make
    * @year           "2014"     integer    : The four-digit year of interest
    * @submodel       ""         string     : The vehicle submodel niceName
    * @category       "4dr SUV"  enumerated : Vehicle Category
    * @view           "basic"    enumerated : The response payload
    * @fmt            "json"     enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_style_count()
    {

    }

    /*
    * GET Get Styles Details by Vehicle Chrome ID /api/vehicle/v2/partners/chrome/styles/:chromeId    *
    * @:makeNiceName  "honda"    string     : Vehicle make niceName
    * @:modelNiceName "pilot"    string     : Vehicle model niceName
    * @:year          "2010"     string     : Vehicle four-digit year
    * @state          "used"     enumerated : The state of the car make
    * @year           "2014"     integer    : The four-digit year of interest
    * @submodel       ""         string     : The vehicle submodel niceName
    * @category       "4dr SUV"  enumerated : Vehicle Category
    * @view           "basic"    enumerated : The response payload
    * @fmt            "json"     enumerated : Response format (json only)
    * @callback == The callback function that the JSON response will be wrapped in if desired
    */
    public function get_style_v_chrome_id()
    {

    }

}