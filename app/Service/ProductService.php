<?php

namespace App\Service;

use App\Repositories\Product\ProductRepositoryInterface;

class ProductService {

    private $product_repository;

    public function __construct(ProductRepositoryInterface $product_repository)
    {
        $this->product_repository = $product_repository;
    }

    public function getProduct()
    {
        $this->product_repository->getProductInformation();
    }

    public function add_product($request){

        $file_name = '';

        $image = $request->file('image');

        if (isset($image) === TRUE ) {
            $ext = $image->guessExtension();

            $file_name = str_random(20) . '{$ext}';

            $path = $image->storeAs('photos', $file_name, 'public');
        }

        $this->product_repository->addProductAndStockRecord($file_name,$request);

    }

    public function update_status($request){
        $this->product_repository->changeStatusPrivateOrPublic($request);
    }

    public function delete_product($id){
        $this->product_repository->deleteProductAndStock($id);
    }

}
