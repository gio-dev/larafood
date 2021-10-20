<?php

namespace App\Repositories;

use App\Repositories\Contracts\TableRepositoryInterface;;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTablesByTenantId(int $idTenant, int $perPage)
    {
        return DB::table($this->table)
            ->where('tenant_id', $idTenant)
            ->paginate($perPage);
    }
    public function getTableByIdentify(int $idTenant,string $identify){
        return DB::table($this->table)
            ->where('identify', $identify)
            ->where('tenant_id', $idTenant)
            ->first();
    }
}
