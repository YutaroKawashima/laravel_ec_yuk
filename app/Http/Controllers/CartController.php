<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartRequest;

class CartController extends Controller
{

    public function cart(){
        $user=Auth::user();
        $title='カート内商品';
        $cart=\App\Cart::where('user_id', $user->id)->get();
        $total_price = $this->total($user->id);

        return view('cart', [
            'title' => $title,
            'cart' => $cart,
            'total_price' => $total_price,
        ]);
    }

    public function add_to_cart(Request $request){

        $user=Auth::user();

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

        $this->total($user->id);

        return redirect('/top');
    }

    public function total($user_id){

        $cart = \App\Cart::where('user_id', $user_id)->get();

        $total_price = 0;
        foreach ( $cart as $cart_item ) {
            $total_price += $cart_item->product->price * $cart_item->amount;
        }

        return $total_price;
    }

    public function update_amount(CartRequest $request){
        $user=Auth::user();
        $cart = \App\Cart::where('user_id', $user->id)->get();
        $amount = $cart->where('product_id',$request->product_id)->first();

        $amount->amount = $request->amount;

        $amount->save();

        return redirect('/cart');
    }

    public function delete($id){

        $product = \App\Cart::find($id);

        $product->delete();

        return redirect('/cart');

    }

    public function finish_shopping(Request $request){

        $title='購入完了ページ';
        $user=Auth::user();
        $total_price = $this->total($user->id);

        $cart = \App\Cart::where('user_id', $user->id)->get();

        foreach ($cart as $cart_items) {
            $stock = \App\Stock::where('product_id', $cart_items->product_id)->first();

            $stock->stock = $stock->stock - $cart_items->amount;

            $stock->save();

            $cart_items->delete();
        }

        return view('finish', [
            'title' => $title,
            'cart' => $cart,
            'total_price' => $total_price,
        ]);
    }

    public function showLoginForm(){
        return view('admin.login');
    }


}
