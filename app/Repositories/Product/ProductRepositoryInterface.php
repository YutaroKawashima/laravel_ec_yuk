<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface
{
    public function addProductAndStockRecord($file_name,$request);

    public function changeStatusPrivateOrPublic($request);

    public function deleteProductAndStock($id);
}
