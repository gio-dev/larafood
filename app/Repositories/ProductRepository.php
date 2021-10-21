<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function getProductsByTenantId(int $idTenant,array $categories, int $perPage)
    {
        return DB::table($this->table)
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('products.tenant_id', $idTenant)
            ->where('categories.tenant_id', $idTenant)
            ->where('categories.tenant_id', $idTenant)
            ->where(function ($query) use ($categories){
                if(is_array($categories) && count($categories) > 0){
                    $query->whereIn('categories.url', $categories);
                }
            })
            ->select('products.*')
            ->paginate($perPage);
    }

    public function getProductByFlag(int $idTenant, string $flag){
        return DB::table($this->table)
            ->where('flag', $flag)
            ->where('tenant_id', $idTenant)
            ->first();
    }
}
