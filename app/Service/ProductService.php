<?php

namespace App\Service;

class ProductService {

    public function add_product($request){

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
    }

    public function update_stock($request){

        $stock = \App\Stock::where('product_id', $request->product_id)->first();

        $stock->stock = $request->update_stock;

        $stock->save();
    }

    public function update_status($request){

        $status = \App\Product::where('id', $request->product_id)->first();

        if ( $request->change_status === '公開 → 非公開' ) {

            $status->status = 0;

        } else if ( $request->change_status === '非公開 → 公開' ) {

            $status->status = 1;

        }

        $status->save();
    }
}
