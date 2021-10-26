<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{

    public function getCategoriesByTenantUuid(string $uuid,int $perPage);
    public function getCategoriesByTenantId(int $idTenant, int $perPage);
    public function getCategoryByUuid(int $idTenant,string $uuid);
}
