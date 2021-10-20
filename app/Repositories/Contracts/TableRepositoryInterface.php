<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTablesByTenantId(int $idTenant, int $perPage);
    public function getTableByIdentify(int $idTenant,string $identify);
}
