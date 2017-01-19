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

    public function makePayment(){

        $charge = Stripe::charges()->create([
            'customer' => 'cus_9xP8n3HnZPLYjx',
            'currency' => 'USD',
            'amount'   => 50.49,
        ]);

        echo $charge['id'];

    }
}
