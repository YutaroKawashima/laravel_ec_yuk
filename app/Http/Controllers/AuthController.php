<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddRequest;
use App\Http\Requests\StockRequest;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth_admin')->except('logout');
    }

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

    public function stock_change(StockRequest $request){
        $stock = \App\Stock::where('product_id', $request->product_id)->first();

        $stock->stock = $request->update_stock;

        $stock->save();

        return redirect('/management');
    }

    public function status_change(Request $request){

        $status = \App\Product::where('id', $request->product_id)->first();

        if ( $request->change_status === '公開 → 非公開' ) {

            $status->status = 0;

        } else if ( $request->change_status === '非公開 → 公開' ) {

            $status->status = 1;

        }

        $status->save();

        return redirect('/management');

    }

    public function delete($id){

        $product = \App\Product::find($id);

        $product->delete();

        return redirect('/management');

    }
}
