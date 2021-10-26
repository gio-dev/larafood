<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByCategories(int $idTenant,array $categories, int $perPage);
    public function getProductByUuid(int $idTenant, string $uuid);
}
