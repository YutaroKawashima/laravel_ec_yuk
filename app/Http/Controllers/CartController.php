<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartRequest;
use App\Service\CartService;

class CartController extends Controller
{

    public function __construct(CartService $cart_service){

        $this->cart_service = $cart_service;
    }

    public function cart(){

        $user=Auth::user();

        $cart= $this->cart_service->getCart();
        $total_price = $this->cart_service->total($user->id);

        return view('cart', [
            'cart' => $cart,
            'total_price' => $total_price,
        ]);
    }

    public function add_to_cart(Request $request){

        $user=Auth::user();

        $this->cart_service->add_product($user,$request);

        $this->cart_service->total($user->id);

        return redirect('/top');
    }

    public function update_amount(CartRequest $request){
        $user=Auth::user();

        $this->cart_service->update_cart($user,$request);

        return redirect('/cart');
    }

    public function delete($id){

        $cart = $this->cart_service->getDeleteID($id);

        $cart->delete();

        return redirect('/cart');

    }

    public function finish_shopping(){

        $title='購入完了ページ';
        $total_price = $this->cart_service->total(auth()->user()->id);

        $cart= $this->cart_service->getCart();

        $this->cart_service->finish();

        return view('finish', [
            'title' => $title,
            'cart' => $cart,
            'total_price' => $total_price,
        ]);
    }

}
