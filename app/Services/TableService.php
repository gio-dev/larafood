<?php

namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TableService
{
    protected $tableRepository;
    protected $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, TableRepositoryInterface $tableRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }

    public function getTablesByUuid(string $uuid, int $perPage){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->tableRepository->getTablesByTenantId($tenant->id, $perPage);
    }
    public function getTableByIdentify(string $uuid,string $identify){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->tableRepository->getTableByIdentify($tenant->id,$identify);
    }
}
