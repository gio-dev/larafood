<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected
//        $tenantService,
        $categoryService;
    public function __construct(
//        TenantService $tenantService,
        CategoryService $categoryService)
    {
//        $this->tenantService = $tenantService;
        $this->categoryService = $categoryService;
    }

    public function getCategoriesByTenant(TenantFormRequest $request)
    {
        $perPage = (int)$request->get('per_page', 25);
        $categories = $this->categoryService->getCategoriesByTenant($request->token_company, $perPage);
        return CategoryResource::collection($categories);
    }
    public function show(TenantFormRequest $request, $identify){
        $category = $this->categoryService->getCategoryByUuid($request->token_company, $identify);
        if(!$category)
            return response()->json(['message'=>'Category not found'], 404);

        return new CategoryResource($category);
    }
}
