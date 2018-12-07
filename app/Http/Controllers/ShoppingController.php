<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Session;
use App\Product;

class ShoppingController extends Controller
{
    public function addToCart()
    {
        $product = Product::find(request()->product_id);

        $cart = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => request()->qty
        ]);

        Cart::associate($cart->rowId, 'App\Product');    
        Session::flash('success', 'Product successfully added to your cart!');
        return redirect()->route('cart');
    }

    public function cart()
    {
        return view('cart');
    }

    public function delete($id)
    {
        Cart::remove($id);
        Session::flash('success', 'Product successfully removed to your cart!');
        return redirect()->back();
    }

    public function increment($id, $qty)
    {
        Cart::update($id, $qty + 1);
        Session::flash('success', 'Product incremented');
        return redirect()->back();
    }

    public function decrement($id, $qty)
    {
        Cart::update($id, $qty - 1);
        Session::flash('success', 'Product decremented');
        return redirect()->back();
    }

    public function addRapidToCart($id)
    {
        $product = Product::find($id);

        $cart = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'qty' => 1
        ]); 

        Cart::associate($cart->rowId, 'App\Product');
        Session::flash('success', 'Product successfully added to your cart!');
        return redirect()->back();
    }
}
