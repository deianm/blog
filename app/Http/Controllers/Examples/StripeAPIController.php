<?php

namespace App\Http\Controllers\Examples;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\DatatablesClass as SSP;
use Stripe;
use DB;

class StripeAPIController extends Controller

{

    public function index()
    {

        return view('examples.payments.index');

    }

    public function makePayment(Request $request_token){

        //Replace the fixed amounts after testing
        $request = $request_token->all();

        $token = $request['token'];

        $charge = Stripe::charges()->create([
            'source' => $token,
            'currency' => 'USD',
            'amount'   => 40.99,
        ]);

        $stripe_payment_id   = $charge['id'];
        $stripe_status       = $charge['status'];
        $stripe_amount       = $charge['amount'];

        DB::table( 'stripe_response' )->insert( [
            'payment_id'         => $stripe_payment_id,
            'status'             => $stripe_status,
            'amount'             => $stripe_amount
        ] );

        echo json_encode($charge);

    }

    public function showStripeResponse(Request $request_stripe) {


        // DB table to use
        $table = 'stripe_response';

        $database = 'personal_db';

        // Table's primary key
        $primaryKey = 'id';

        $request = $request_stripe->all();

        $columns = [
            [ 'db' => 'id', 'dt' => 0 ],
            [ 'db' => 'payment_id', 'dt' => 1 ],
            [ 'db' => 'status', 'dt' => 2 ],
            [ 'db' => 'amount', 'dt' => 3 ],
            [ 'db' => 'created_at', 'dt' => 4 ]
        ];

        echo json_encode( SSP::simpleJoin( $request, $table, $primaryKey, $columns, $joins = [ ], $initFilter = [ ], $forceInit = false, $database ) );


    }
}
