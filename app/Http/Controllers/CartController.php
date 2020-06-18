<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add_cart(){
        $user=Auth::user();

        $user->add_to_cart($product_id);

        return redirect('/cart');
    }
}
