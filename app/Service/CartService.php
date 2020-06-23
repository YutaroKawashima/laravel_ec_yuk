<?php

namespace App\Service;

use App\Cart;

use App\Repositories\Cart\CartRepositoryInterface;

class CartService {

    private $cart_repository;

    public function __construct(CartRepositoryInterface $cart_repository)
    {
        $this->cart_repository = $cart_repository;
    }

    public function total($user_id){

        $cart = \App\Cart::where('user_id', $user_id)->get();

        $total_price = 0;
        foreach ( $cart as $cart_item ) {
            $total_price += $cart_item->product->price * $cart_item->amount;
        }

        return $total_price;
    }

    public function add_product($user,$request){

        $this->cart_repository->addProductToCart($user,$request);
    }

    public function update_cart($user,$request){

        $this->cart_repository->updateAmountRecordInCart($user,$request);
    }

    public function finish($user){

        $this->cart_repository->doShoppingFromCart($user);
    }
}
