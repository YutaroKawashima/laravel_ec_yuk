<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddRequest;
use App\Http\Requests\StockRequest;
use App\Service\ProductService;


class AuthController extends Controller
{

    public function __construct(ProductService $product_service)
    {
        $this->middleware('auth_admin')->except('logout');

        $this->product_service = $product_service;
    }

    public function management() {

        $product = \App\Product::all();

        return view('management', [
            'product' => $product,
        ]);
    }

    public function conditions(AddRequest $request){

        $file_name = '';

        $image = $request->file('image');

        $this->product_service->add_product($request);

        return redirect('/admin/management');
    }

    public function stock_change(StockRequest $request){

        $this->product_service->update_stock($request);

        return redirect('/admin/management');
    }

    public function status_change(Request $request){

        $this->product_service->update_status($request);

        return redirect('/admin/management');

    }

    public function delete($id){

        $this->product_service->delete_product($id);

        return redirect('/admin/management');

    }
}
