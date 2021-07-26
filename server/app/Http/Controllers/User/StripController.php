<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripController extends Controller
{
    public function stripeOrder(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => 999*100,
            'currency' => 'jpy',
            'description' => 'Easy Online Store',
            'source' => $token,
            'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
    }
}
