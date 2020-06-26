<?php

namespace App\Repositories\Product;

use App\Product;
use App\Stock;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product, Stock $stock)
    {
        $this->product = $product;
        $this->stock = $stock;
    }

    public function addProductAndStockRecord($file_name,$request){

        $this->product->name = $request->name;
        $this->product->price = $request->price;
        $this->product->image = $file_name;
        $this->product->status = $request->status;
        $this->product->save();

        $this->stock->product_id = $product->id;
        $this->stock->stock = $request->stock;
        $this->stock->save();

    }

    public function changeStatusPrivateOrPublic($request){

        $product = $this->product->where('id', $request->product_id)->first();

        if ( $request->change_status === '0' ) {

            $product->status = 0;

        } else if ( $request->change_status === '1' ) {

            $product->status = 1;

        }

        $product->save();
    }

    public function deleteProductAndStock($id){
        $product = $this->product->find($id);
        $stock = $this->stock->where('product_id',$id);

        $product->delete();
        $stock->delete();
    }
}
