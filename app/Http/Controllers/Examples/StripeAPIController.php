<?php

namespace App\Http\Controllers\Examples;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;

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

        echo json_encode($charge);

    }
}
