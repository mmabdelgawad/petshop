<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository
{
    public function __construct(private Product $productModel)
    {
    }

    public function search(Request $request)
    {
        return $this->productModel->search($request);
    }

}
