<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService
{
    protected $categoryRepository;
    protected $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesByTenant(string $uuid, int $perPage){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->categoryRepository->getCategoriesByTenantId($tenant->id, $perPage);
    }
    public function getCategoryByUuid(string $uuid,string $identify){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->categoryRepository->getCategoryByUuid($tenant->id,$identify);
    }
}
