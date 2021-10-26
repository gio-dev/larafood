<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(TenantFormRequest $request)
    {
        $perPage = (int)$request->get('per_page', 25);
        $products = $this->productService->getProductsByCategories($request->token_company,
            $request->get('categories', []), $perPage);
        return ProductResource::collection($products);
    }
    public function show(TenantFormRequest $request, $identify){
        $product = $this->productService->getProductByUuid($request->token_company, $identify);
        if(!$product)
            return response()->json(['message'=>'Product not found'], 404);

        return new ProductResource($product);
    }
}
