<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Mail;
use Session;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function pay()
    {   
       Stripe::setApiKey("sk_test_UHZ0rqTyvaQzQfDispUgzUW6");

        $charge = Charge::create([
            'amount' => Cart::total() * 100,
            'currency' => 'usd',
            'source' => request()->stripeToken,
            'receipt_email' => request()->stripeEmail,
        ]);

        Cart::destroy();
        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);
        Session::flash('success', 'Thank you! We have received your order. Please check your email.');
        return redirect()->route('home');
    }
}
