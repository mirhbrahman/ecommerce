<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use Session;

class ShoppingController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $pdt = Product::find($request->pdt_id);

        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => $request->qty,
            'price' => $pdt->price,
            'image'=>$pdt->image
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');
        Session::flash('success','Product is added to cart.');
        return redirect()->route('cart');
    }

    public function cart()
    {
        return view('cart');
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        Session::flash('success','Product is deleted from cart.');
        return redirect()->back();
    }

    public function incr($id, $qty)
    {
        Cart::update($id, $qty+1);
        Session::flash('success','Product is update in cart.');
        return redirect()->back();
    }

    public function decr($id, $qty)
    {
        Cart::update($id, $qty-1);
        Session::flash('success','Product is update in cart.');
        return redirect()->back();
    }

    public function rapid_add(Request $request,$id)
    {
        $pdt = Product::find($id);

        $cartItem = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'qty' => 1,
            'price' => $pdt->price,
            'image'=>$pdt->image
        ]);

        Cart::associate($cartItem->rowId, 'App\Product');
        Session::flash('success','Product is added to cart.');
        return redirect()->route('cart');
    }

}
