<?php

namespace App\Service;

use App\Cart;

class CartService {

    public function total($user_id){

        $cart = \App\Cart::where('user_id', $user_id)->get();

        $total_price = 0;
        foreach ( $cart as $cart_item ) {
            $total_price += $cart_item->product->price * $cart_item->amount;
        }

        return $total_price;
    }

    public function add_product($user,$request){

        if ( $user->carts->where('product_id', $request->product_id)->isEmpty() ) {

            $cart = new \App\Cart;

            $cart->user_id = $user->id;
            $cart->product_id = $request->product_id;
            $cart->amount = 1;

        } else {

            $cart = $user->carts->where('product_id', $request->product_id)->first();
            $cart->amount += 1;
        }

        $cart->save();
    }

    public function update_cart($user,$request){

        $cart = \App\Cart::where('user_id', $user->id)->get();
        $amount = $cart->where('product_id',$request->product_id)->first();

        $amount->amount = $request->amount;

        $amount->save();
    }

    public function finish($user){

        $cart = \App\Cart::where('user_id', $user->id)->get();

        foreach ($cart as $cart_items) {
            $stock = \App\Stock::where('product_id', $cart_items->product_id)->first();

            $stock->stock = $stock->stock - $cart_items->amount;

            $stock->save();

            $cart_items->delete();
        }
    }
}
