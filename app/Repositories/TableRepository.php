<?php

namespace App\Repositories;

use App\Models\Table;
use App\Repositories\Contracts\TableRepositoryInterface;;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
//    protected $table;
    /**
     * @var Table
     */
    protected $entity;

//    public function __construct()
    public function __construct(Table $table)
    {
//        $this->table = 'tables';
        $this->entity = $table;
    }

    public function getTablesByTenantId(int $idTenant, int $perPage)
    {
//        return DB::table($this->table)
        return $this->entity
            ->where('tenant_id', $idTenant)
            ->paginate($perPage);
    }
    public function getTableByIdentify(int $idTenant,string $identify){
//        return DB::table($this->table)
        return $this->entity
            ->where('identify', $identify)
            ->where('tenant_id', $idTenant)
            ->first();
    }
}
