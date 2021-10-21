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

    public function getProductsByUuid(string $uuid, array $categories, int $perPage){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->productRepository->getProductsByTenantId($tenant->id,$categories, $perPage);
    }
    public function getProductByFlag(string $uuid,string $flag){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->productRepository->getProductByFlag($tenant->id,$flag);
    }
}
