<?php

namespace App\Http\Controllers\Examples;

use App\Classes\DatatablesClass as SSP;
use App\Classes\CouponGenerator AS COUPON;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class CouponSystemController extends Controller {


    public function index() {
        $pg = [
            'site'       => 'fans2cash',
            'page'       => 'generatecoupons',
            'page_title' => 'Advertisers'
        ];

        return view( 'examples.coupons.index', $pg );
    }

    public function generateCoupon(Request $request_coupon) {

        $request = $request_coupon->all();

        $confirmation_data = [ ];

        $coupon_type = $request['coupon_type'];
        $amount      = $request['amount'];
        $start_date  = $request['start_date'];
        $end_date    = $request['end_date'];
        $numbers     = $request['numbers'];
        $letters     = $request['letters'];
        $mask        = $request['mask'];
        $qty_coupons = $request['coupon_limit'];

        if ( empty( $request['users'] ) ) {
            $users_array = [ ];
        } else {
            $users_array = $request['users'];
        }

        /*
         * Clears user array if type 1 and 3 are not empty because of JS not clearing
         */
        if (  ($coupon_type == 1 || $coupon_type == 3)  && ! empty( $request['users'] ) )   {

            $users_array = [ ];

        }

        /*
         * Validation for selected users and amount
         */
        if ( $coupon_type == 2 && empty( $request['users'] ) ) {

            $data = [
                'error'   => 'empty_user',
                'message' => 'Please select at least 1 user to use this feature!'
            ];

            return $data;

        }

        $fa = floatval ( $amount );
        $epsilon = 0.01;

        if ( abs( $fa - 0.00) < $epsilon ) {

            $data = [
                'error'   => 'amount',
                'message' => 'Please enter a value greater or equal to $0.01'
            ];

            return $data;

        }

        if ( $qty_coupons == 0 ) {

            $data = [
                'error'   => 'qty_coupon',
                'message' => 'Please enter a value greater than 0 for coupons'
            ];

            return $data;

        }

        /*
         * End Validation
         */

        $advertiser_result = '';

        if ( ! empty( $users_array ) ) {

            foreach ( $users_array as $key => $val ) {

                $advertiser_result[ $key ] = DB::table( 'advertisers_user' )
                    ->select( 'id', 'first_name', 'last_name' )
                    ->where( 'id', '=', $val )
                    ->first();
            }
        }

        $coupon_exists = 1;
        $safety_counter = 0;

        do {

            $coupon = COUPON::generate_coupons( $no_of_coupons = 1, $length = 25, $prefix = null, $suffix = null, $numbers, $letters, $symbols = null, $random_register = null, $mask );

            $coupon_exists = DB::table( 'example_coupon' )
                ->where( 'coupon_code', '=', $coupon )
                ->count();

            if ( $coupon_exists == 0 ) {

                $confirmation_data = [
                    'confirmation_coupon_type'  => $coupon_type,
                    'confirmation_amount'       => $amount,
                    'confirmation_end_date'     => $end_date,
                    'confirmation_start_date'   => $start_date,
                    'confirmation_coupon'       => $coupon[0],
                    'confirmation_advertiser'   => $advertiser_result,
                    'confirmation_coupon_limit' => $qty_coupons
                ];

                return $confirmation_data;

            }

            $safety_counter++;

            if ( $safety_counter >= 10 ) {
                $data = [
                    'error'   => 'try_again',
                    'message' => 'Sorry, something happened, please try again.'
                ];

                return $data;
            }

        } while ( ( $coupon_exists != 0 ) && ( $safety_counter <= 10 ) );

    }

    /**
     *
     *
     */
    public function getAllCoupons(Request $request_coupon) {

        // DB table to use
        $table = 'example_coupon';

        $database = 'personal_db';

        // Table's primary key
        $primaryKey = 'id';

        $request = $request_coupon->all();

        $columns = [
            [ 'db' => 'id', 'dt' => 0 ],
            [ 'db' => 'coupon_code', 'dt' => 1 ],
            [ 'db' => 'amount', 'dt' => 2 ],
            [ 'db' => 'start_date', 'dt' => 3 ],
            [ 'db' => 'end_date', 'dt' => 4 ],
            [ 'db' => 'date_generated', 'dt' => 5 ],
            [ 'db' => 'coupon_type', 'dt' => 6 ],
            [ 'db' => 'status', 'dt' => 7 ]
        ];

        echo json_encode( SSP::simpleJoin( $request, $table, $primaryKey, $columns, $joins = [ ], $initFilter = [ ], $forceInit = false, $database ) );

    }

    public function submitCoupon(Request $request_coupon) {

        $request = $request_coupon->all();

        if ( empty( $request['confirmed_advertiser_id'] ) ) {
            $confirmed_advertiser = [ ];
        } else {
            $confirmed_advertiser = $request['confirmed_advertiser_id'];
        }

        $advertiser_id = [ ];

        for ( $i = 0, $len = count( $confirmed_advertiser ); $i < $len; $i ++ ) {

            $data            = $confirmed_advertiser[ $i ]['value'];
            $advertiser_id[] = $data;

        }

        $confirmed_coupon_type  = $request['confirmed_coupon_type'];
        $confirmed_amount       = $request['confirmed_amount'];
        $confirmed_coupon       = $request['confirmed_coupon'];
        $confirmed_start_date   = $request['confirmed_start_date'];
        $confirmed_end_date     = $request['confirmed_end_date'];
        $confirmed_coupon_limit = $request['confirmed_coupon_limit'];

        DB::table( 'example_coupon' )->insert( [
            'status'         => 1,
            'coupon_type'    => $confirmed_coupon_type,
            'amount'         => $confirmed_amount,
            'coupon_code'    => $confirmed_coupon,
            'start_date'     => $confirmed_start_date,
            'end_date'       => $confirmed_end_date,
            'coupon_counter' => $confirmed_coupon_limit,
            'unique_user'    => json_encode( $advertiser_id )
        ] );

    }

    public function updateCoupon(Request $request_coupon) {
        $request = $request_coupon->all();
        //Extra feature

    }

    public function deleteCoupon(Request $request_coupon) {

        //permanent delete

        $request = $request_coupon->all();

        $coupon_id = $request['coupon_id'];

        DB::table( 'example_coupon' )->where( 'id', '=', $coupon_id )->delete();
    }

    public function pauseCoupon(Request $request_coupon) {

        //pause by Admin

        $request = $request_coupon->all();

        $coupon_id = $request['coupon_id'];

        DB::table( 'example_coupon' )->where( 'id', '=', $coupon_id )->update( [
            'status' => '9'
        ] );


    }

    public function resumeCoupon(Request $request_coupon) {

        //reverse pause

        $request = $request_coupon->all();

        $coupon_id = $request['coupon_id'];

        DB::table( 'example_coupon' )->where( 'id', '=', $coupon_id )->update( [
            'status' => '1'
        ] );

    }

    public function couponUsage(Request $request_coupon) {

        $request = $request_coupon->all();

        $coupon_id = $request['coupon_id'];

        $results = DB::table( 'example_redeemed_coupons' )
            ->join( 'advertisers_user', 'advertisers_redeemed_coupons.advertiser_id', '=', 'advertisers_user.id' )
            ->select( 'advertiser_id', 'first_name', 'last_name' )
            ->where( 'coupon_id', '=', $coupon_id )->get();

        $usage_count['raw_count'] = count( $results );

        $data = [ ];

        foreach ( $results as $result ) {

            $data['user_information'][] = [
                'id'         => $result->advertiser_id,
                'first_name' => $result->first_name,
                'last_name'  => $result->last_name
            ];

        }

        $data['usage_count'][] = $usage_count;

        return $data;

    }

    public function getAdvertiserList(Request $request_coupon) {

        $request = $request_coupon->all();

        $search = strip_tags( trim( $request['search'] ) );

        $results = DB::table( 'advertisers_user' )
            ->where( 'id', 'LIKE', '%' . $search . '%' )
            ->orWhere( 'first_name', 'LIKE', '%' . $search . '%' )
            ->orWhere( 'last_name', 'LIKE', '%' . $search . '%' )
            ->orWhere( 'email', 'LIKE', '%' . $search . '%' )
            ->get();

        $data = [ ];

        foreach ( $results as $result ) {

            $data[] = [
                'id'            => $result->id,
                'text'          => '(' . $result->id . ')' . ' ' . $result->first_name . ' ' . $result->last_name,
                'advertiser_id' => $result->id,
                'email'         => $result->email
            ];

        }

        echo json_encode( $data );

    }

    public function sendEmailNotification() {

        //Future option

    }

}

