<?php

namespace App\Repositories\Product;

use App\Product;
use App\Stock;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addProductAndStockRecord($file_name,$request){

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

    public function changeStatusPrivateOrPublic($request){

        $status = \App\Product::where('id', $request->product_id)->first();

        if ( $request->change_status === '公開 → 非公開' ) {

            $status->status = 0;

        } else if ( $request->change_status === '非公開 → 公開' ) {

            $status->status = 1;

        }

        $status->save();
    }

    public function deleteProductAndStock($id){
        $product = \App\Product::find($id);
        $stock = \App\Stock::where('product_id',$id);

        $product->delete();
        $stock->delete();
    }
}
