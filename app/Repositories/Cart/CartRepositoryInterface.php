<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function addProductToCart($user,$request);

    public function updateAmountRecordInCart($user,$request);

    public function doShoppingFromCart($user);
}
