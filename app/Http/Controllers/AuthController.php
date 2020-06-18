<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddRequest;

class AuthController extends Controller
{
    public function management() {
        $title = '商品管理ページ';
        $product = \App\Product::all();

        return view('management', [
            'title' => $title,
            'product' => $product
        ]);
    }

    public function conditions(AddRequest $request){

        $file_name = '';

        $image = $request->file('image');

        if (isset($image) === TRUE ) {
            $ext = $image->guessExtension();

            $file_name = str_random(20) . '{$ext}';

            $path = $image->storeAs('photos', $file_name, 'public');
        }

        $product = new \App\Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->image = $file_name;
        $product->status = $request->status;
        $product->save();


        $stock = new \App\Stock;

        $stock->product_id = $product->id;
        $stock->stock = $request->stock;
        $stock->save();

        return redirect('/management');
    }
}
