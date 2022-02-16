<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function listing(Request $request)
    {
        return $this->productRepository->search($request);
    }
}
