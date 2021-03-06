<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function top(){
        $title = '商品一覧ページ';
        $product =  \App\Product::all();

        return view('top', [
            'title' => $title,
            'product' => $product
        ]);
    }

    public function cart(){
        $title='カート内商品';
        $cart=\App\Cart::all();

        return view('cart', [
            'title' => $title,
            'cart' => $cart
        ]);
    }
}
