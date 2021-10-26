<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTablesByTenantId(int $idTenant, int $perPage);
    public function getTableByUuid(int $idTenant,string $uuid);
}
