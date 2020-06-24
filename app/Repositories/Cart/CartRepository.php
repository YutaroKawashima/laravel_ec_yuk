<?php

namespace App\Repositories\Cart;

use App\Product;
use App\Stock;
use App\Cart;

class CartRepository implements CartRepositoryInterface
{
    protected $cart;

    public function __construct(Cart $cart,Stock $stock)
    {
        $this->cart = $cart;
        $this->stock = $stock;
    }

    public function addProductToCart($user,$request){
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

    public function updateAmountRecordInCart($user,$request){

        $cart = \App\Cart::where('user_id', $user->id)->get();
        $amount = $cart->where('product_id',$request->product_id)->first();

        $amount->amount = $request->amount;

        $amount->save();
    }

    public function doShoppingFromCart(){

        $cart = \App\Cart::where('user_id', auth()->user()->id)->get();

        foreach ($cart as $cart_items) {
            $this->stock->where('product_id', $cart_items->product_id)->first();

            $this->$stock->stock = $this->$stock->stock - $cart_items->amount;

            $this->$stock->save();

            $cart_items->delete();
        }
    }

}
