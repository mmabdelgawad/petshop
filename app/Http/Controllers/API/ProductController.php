<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $service)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    /**
     * @OA\Get (
     *      path="/products",
     *      operationId="products",
     *      security={{"bearer_token":{}}},
     *      tags={"Products"},
     *      summary="List all products",
     *      description="products filter",
     *      @OA\Parameter(
     *          name="category",
     *          description="Product Category",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="Product Price",
     *          in="query",
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="brand",
     *          description="Product Brand",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="title",
     *          description="Product Title",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="sort",
     *          description="Product Sort (ASC or DESC)",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="limit",
     *          description="Product Limit",
     *          in="query",
     *          example=10,
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="Product Page",
     *          in="query",
     *          example=1,
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *     )
     *      @OA\Response(
     *          response=400,
     *          description="Bearer Token is missing",
     *          @OA\JsonContent()
     *       ),
     *     )
     */
    public function index(Request $request)
    {
        return ProductCollection::make($this->service->listing($request));
    }
}
