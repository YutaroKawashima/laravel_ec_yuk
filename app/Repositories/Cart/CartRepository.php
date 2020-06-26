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

    public function getCartInformation()
    {
        $cart = $this->cart->where('user_id', auth()->user()->id)->get();

        return $cart;
    }

    public function getCartInfoByID($id)
    {
        $cart = $this->cart->where('user_id', $id)->get();

        return $cart;
    }

    public function addProductToCart($user, $request)
    {
        if ( $user->carts->where('product_id', $request->product_id)->isEmpty() ) {

            $this->cart->user_id = $user->id;
            $this->cart->product_id = $request->product_id;
            $this->cart->amount = 1;

        } else {

            $this->cart = $user->carts->where('product_id', $request->product_id)->first();
            $this->cart->amount += 1;
        }

        $this->cart->save();
    }

    public function updateAmountRecordInCart($user, $request)
    {

        $cart = $this->cart->where('user_id', $user->id)->where('product_id', $request->product_id)->first();

        $cart->amount = $request->amount;

        $cart->save();
    }

    public function doShoppingFromCart()
    {

        $cart = $this->cart->where('user_id', auth()->user()->id)->get();

        foreach ($cart as $cart_items) {

            $stock = $this->stock->where('product_id', $cart_items->product_id)->first();

            $stock->stock = $stock->stock - $cart_items->amount;

            $stock->save();

            $cart_items->delete();
        }
    }

}
