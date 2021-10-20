<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService
{
    protected $categoryRepository;
    protected $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, CategoryRepository $categoryRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesByUuid(string $uuid, int $perPage){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->categoryRepository->getCategoriesByTenantId($tenant->id, $perPage);
    }
    public function getCategoryByUrl(string $uuid,string $url){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->categoryRepository->getCategoryByUrl($tenant->id,$url);
    }
}
