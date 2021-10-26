<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{
    protected $productRepository;
    protected $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, ProductRepositoryInterface $productRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->productRepository = $productRepository;
    }

    public function getProductsByCategories(string $uuid, array $categories, int $perPage){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->productRepository->getProductsByCategories($tenant->id,$categories, $perPage);
    }
    public function getProductByUuid(string $uuid,string $identify){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->productRepository->getProductByUuid($tenant->id,$identify);
    }
}
