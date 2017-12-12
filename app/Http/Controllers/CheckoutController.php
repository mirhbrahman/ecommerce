<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Session;
use Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::content()->count() == 0) {
            Session::flash('info', 'Your cart is still empty. do some shopping.');
            return redirect()->back();
        }
        return view('checkout');
    }

    public function pay(Request $request)
    {
        Stripe::setApiKey("sk_test_1399MaKv738AQYmbKKHSpHN4");
        $token = $request->stripeToken;
        $charge = Charge::create(array(
            "amount" => Cart::total() * 100,
            "currency" => "usd",
            "description" => "Example charge",
            "source" => $token,
        ));

        Session::flash('success','Purchase successfull. Wait for our email.');
        Cart::destroy();

        Mail::to($request->stripeEmail)->send(new \App\Mail\PurchaseSuccessfull);

        return redirect('/');
    }
}
